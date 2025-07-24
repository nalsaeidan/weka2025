<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// إعداد الاتصال بقاعدتين
$source = new PDO('mysql:host=localhost;dbname=pro2test;charset=utf8mb4', 'root', '');
$target = new PDO('mysql:host=localhost;dbname=demo;charset=utf8mb4', 'root', '');

// رقم العميل المطلوب نقله
$client_id = 53;

// جلب العميل من القاعدة القديمة
$client = $source->prepare("SELECT * FROM business WHERE id = ?");
$client->execute([$client_id]);
$client_data = $client->fetch(PDO::FETCH_ASSOC);

if (!$client_data) {
    die("❌ لا يوجد عميل بهذا الرقم.");
}

// هل هذا العميل موجود في القاعدة الجديدة؟
$check = $target->prepare("SELECT COUNT(*) FROM business WHERE id = ?");
$check->execute([$client_id]);
if ($check->fetchColumn() > 0) {
    die("⚠️ العميل بنفس رقم ID موجود مسبقًا في القاعدة الجديدة.");
}

// ——— بدء النقل ———

$target->beginTransaction();

try {
    // إدخال العميل
    insertRow($target, 'business', $client_data);

    // نقل الفروع
    migrateRelated($source, $target, 'business_locations', 'business_id', $client_id);

    // نقل المستخدمين
    migrateRelated($source, $target, 'users', 'business_id', $client_id);

    // نقل المنتجات
    migrateRelated($source, $target, 'products', 'business_id', $client_id);

    // نقل الأصناف
    $stmt = $source->prepare("SELECT v.* FROM variations v JOIN products p ON v.product_id = p.id WHERE p.business_id = ?");
    $stmt->execute([$client_id]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        insertRow($target, 'variations', $row);
    }

    // نقل تفاصيل الفروع للمنتجات
    $stmt = $source->prepare("
        SELECT vld.*
        FROM variation_location_details vld
        JOIN variations v ON vld.variation_id = v.id
        JOIN products p ON v.product_id = p.id
        WHERE p.business_id = ?
    ");
    $stmt->execute([$client_id]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        insertRow($target, 'variation_location_details', $row);
    }

    // المعاملات
    migrateRelated($source, $target, 'transactions', 'business_id', $client_id);

    // الاشتراكات
    migrateRelated($source, $target, 'subscriptions', 'business_id', $client_id);

    $target->commit();
    echo "✅ تم نقل بيانات العميل بالكامل بنجاح.\n";

} catch (Exception $e) {
    $target->rollBack();
    die("❌ حدث خطأ: " . $e->getMessage());
}


// ----------------- دوال مساعدة -----------------

function migrateRelated($src, $dst, $table, $key, $val) {
    $stmt = $src->prepare("SELECT * FROM $table WHERE $key = ?");
    $stmt->execute([$val]);
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        insertRow($dst, $table, $row);
    }
}

function insertRow($pdo, $table, $data) {
    $cols = implode(',', array_keys($data));
    $placeholders = implode(',', array_fill(0, count($data), '?'));
    $stmt = $pdo->prepare("INSERT INTO $table ($cols) VALUES ($placeholders)");
    $stmt->execute(array_values($data));
}
?>
