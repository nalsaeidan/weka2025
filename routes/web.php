<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function(Request $request) {
     $token = request()->query('token');
    
    if ($token !== 'Naif@12361168') {
        abort(403, 'Unauthorized');
    }

    try {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        return '✅ Cache cleared successfully.';
    } catch (\Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});

Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return 'Migration DONE'; //Return anything
});

include_once('install_r.php');

Route::middleware(['setData'])->group(function () {
    Route::get('/','HomeController@welcome');

    Auth::routes();

    Route::get('/business/register', 'BusinessController@getRegister')->name('business.getRegister');
    Route::post('/business/register', 'BusinessController@postRegister')->name('business.postRegister');
    Route::post('/business/register/check-username', 'BusinessController@postCheckUsername')->name('business.postCheckUsername');
    Route::post('/business/register/check-email', 'BusinessController@postCheckEmail')->name('business.postCheckEmail');
    Route::get('/pricing_pakages', 'BusinessController@pricing')->name('business.pricing_pakages');

    Route::get('/invoice/{token}', 'SellPosController@showInvoice')
        ->name('show_invoice');
    Route::get('/quote/{token}', 'SellPosController@showInvoice')
        ->name('show_quote');
});

// Routes for authenticated users only
Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu', 'CheckUserLogin'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/business/success-payment', 'BusinessController@successPayment')->name('fatoorah.success.payment');
    Route::get('/business/error-payment', 'BusinessController@errorPayment')->name('fatoorah.error.payment');

    Route::get('/home/get-totals', 'HomeController@getTotals');
    Route::get('/home/product-stock-alert', 'HomeController@getProductStockAlert');
    Route::get('/home/purchase-payment-dues', 'HomeController@getPurchasePaymentDues');
    Route::get('/home/sales-payment-dues', 'HomeController@getSalesPaymentDues');
    Route::post('/attach-medias-to-model', 'HomeController@attachMediasToGivenModel')->name('attach.medias.to.model');
    Route::get('/calendar', 'HomeController@getCalendar')->name('calendar');
    
    Route::post('/test-email', 'BusinessController@testEmailConfiguration');
    Route::post('/test-sms', 'BusinessController@testSmsConfiguration');
    Route::get('/business/settings', 'BusinessController@getBusinessSettings')->name('business.getBusinessSettings');
    Route::post('/business/update', 'BusinessController@postBusinessSettings')->name('business.postBusinessSettings');
    Route::get('/user/profile', 'UserController@getProfile')->name('user.getProfile');
    Route::post('/user/update', 'UserController@updateProfile')->name('user.updateProfile');
    Route::post('/user/update-password', 'UserController@updatePassword')->name('user.updatePassword');

    Route::resource('brands', 'BrandController');
    
    Route::resource('payment-account', 'PaymentAccountController');
    Route::resource('tax-rates', 'TaxRateController');
    Route::resource('units', 'UnitController');

    Route::get('/contacts/payments/{contact_id}', 'ContactController@getContactPayments');
    Route::get('/contacts/map', 'ContactController@contactMap');
    Route::get('/contacts/update-status/{id}', 'ContactController@updateStatus');
    Route::get('/contacts/stock-report/{supplier_id}', 'ContactController@getSupplierStockReport');
    Route::get('/contacts/ledger', 'ContactController@getLedger');
    Route::post('/contacts/send-ledger', 'ContactController@sendLedger');
    Route::get('/contacts/import', 'ContactController@getImportContacts')->name('contacts.import');
    Route::post('/contacts/import', 'ContactController@postImportContacts');
    Route::post('/contacts/check-contact-id', 'ContactController@checkContactId');
    Route::get('/contacts/customers', 'ContactController@getCustomers');
    Route::resource('contacts', 'ContactController');

    Route::get('taxonomies-ajax-index-page', 'TaxonomyController@getTaxonomyIndexPage');
    Route::resource('taxonomies', 'TaxonomyController');

    Route::resource('variation-templates', 'VariationTemplateController');
    Route::resource('accounts', 'AccountsController');
    Route::resource('restricts', 'RestrictController');
    
    Route::get('/products/stock-history/{id}', 'ProductController@productStockHistory');
    Route::get('/delete-media/{media_id}', 'ProductController@deleteMedia');
    Route::post('/products/mass-deactivate', 'ProductController@massDeactivate');
    Route::get('/products/activate/{id}', 'ProductController@activate');
    Route::get('/products/view-product-group-price/{id}', 'ProductController@viewGroupPrice');
    Route::get('/products/add-selling-prices/{id}', 'ProductController@addSellingPrices');
    Route::post('/products/save-selling-prices', 'ProductController@saveSellingPrices');
    Route::post('/products/mass-delete', 'ProductController@massDestroy');
    Route::get('/products/view/{id}', 'ProductController@view');
    Route::get('/products/list', 'ProductController@getProducts');
    Route::get('/products/list-no-variation', 'ProductController@getProductsWithoutVariations');
    Route::post('/products/bulk-edit', 'ProductController@bulkEdit');
    Route::post('/products/bulk-update', 'ProductController@bulkUpdate');
    Route::post('/products/bulk-update-location', 'ProductController@updateProductLocation');
    Route::get('/products/get-product-to-edit/{product_id}', 'ProductController@getProductToEdit');
    
    Route::post('/products/get_sub_categories', 'ProductController@getSubCategories');
    Route::get('/products/get_sub_units', 'ProductController@getSubUnits');
    Route::post('/products/product_form_part', 'ProductController@getProductVariationFormPart');
    Route::post('/products/get_product_variation_row', 'ProductController@getProductVariationRow');
    Route::post('/products/get_variation_template', 'ProductController@getVariationTemplate');
    Route::get('/products/get_variation_value_row', 'ProductController@getVariationValueRow');
    Route::post('/products/check_product_sku', 'ProductController@checkProductSku');
    Route::get('/products/quick_add', 'ProductController@quickAdd');
    Route::post('/products/save_quick_product', 'ProductController@saveQuickProduct');
    Route::get('/products/get-combo-product-entry-row', 'ProductController@getComboProductEntryRow');
    
    Route::resource('products', 'ProductController');

    Route::post('/purchases/update-status', 'PurchaseController@updateStatus');
    Route::get('/purchases/get_products', 'PurchaseController@getProducts');
    Route::get('/purchases/get_suppliers', 'PurchaseController@getSuppliers');
    Route::post('/purchases/get_purchase_entry_row', 'PurchaseController@getPurchaseEntryRow');
    Route::post('/purchases/check_ref_number', 'PurchaseController@checkRefNumber');
    Route::resource('purchases', 'PurchaseController')->except(['show']);

    Route::get('/toggle-subscription/{id}', 'SellPosController@toggleRecurringInvoices');
    Route::post('/sells/pos/get-types-of-service-details', 'SellPosController@getTypesOfServiceDetails');
    Route::get('/sells/subscriptions', 'SellPosController@listSubscriptions');
    Route::get('/sells/duplicate/{id}', 'SellController@duplicateSell');
    Route::get('/sells/drafts', 'SellController@getDrafts');
    Route::get('/sells/convert-to-draft/{id}', 'SellPosController@convertToInvoice');
    Route::get('/sells/convert-to-proforma/{id}', 'SellPosController@convertToProforma');
    Route::get('/sells/quotations', 'SellController@getQuotations');
    Route::get('/sells/draft-dt', 'SellController@getDraftDatables');
    Route::resource('sells', 'SellController')->except(['show']);

    Route::get('/import-sales', 'ImportSalesController@index');
    Route::post('/import-sales/preview', 'ImportSalesController@preview');
    Route::post('/import-sales', 'ImportSalesController@import');
    Route::get('/revert-sale-import/{batch}', 'ImportSalesController@revertSaleImport');

    Route::get('/sells/pos/get_product_row/{variation_id}/{location_id}', 'SellPosController@getProductRow');
    Route::post('/sells/pos/get_payment_row', 'SellPosController@getPaymentRow');
    Route::post('/sells/pos/get-reward-details', 'SellPosController@getRewardDetails');
    Route::get('/sells/pos/get-recent-transactions', 'SellPosController@getRecentTransactions');
    Route::get('/sells/pos/get-product-suggestion', 'SellPosController@getProductSuggestion');
    Route::get('/sells/pos/get-featured-products/{location_id}', 'SellPosController@getFeaturedProducts');
    Route::resource('pos', 'SellPosController');

    Route::resource('roles', 'RoleController');
    Route::resource('users', 'ManageUserController');
    Route::resource('group-taxes', 'GroupTaxController');

    Route::get('/barcodes/set_default/{id}', 'BarcodeController@setDefault');
    Route::resource('barcodes', 'BarcodeController');

    Route::get('/invoice-schemes/set_default/{id}', 'InvoiceSchemeController@setDefault');
    Route::resource('invoice-schemes', 'InvoiceSchemeController');

    Route::get('/labels/show', 'LabelsController@show')->name('labels.show');
    Route::get('/labels/add-product-row', 'LabelsController@addProductRow');
    Route::get('/labels/preview', 'LabelsController@preview');

    Route::get('/reports/purchase-report', 'ReportController@purchaseReport');
    Route::get('/reports/sale-report', 'ReportController@saleReport');
    Route::get('/reports/service-staff-report', 'ReportController@getServiceStaffReport');
    Route::get('/reports/service-staff-line-orders', 'ReportController@serviceStaffLineOrders');
    Route::get('/reports/table-report', 'ReportController@getTableReport');
    Route::get('/reports/profit-loss', 'ReportController@getProfitLoss');
    Route::get('/reports/get-opening-stock', 'ReportController@getOpeningStock');
    Route::get('/reports/purchase-sell', 'ReportController@getPurchaseSell');
    Route::get('/reports/customer-supplier', 'ReportController@getCustomerSuppliers');
    Route::get('/reports/stock-report', 'ReportController@getStockReport');
    Route::get('/reports/stock-details', 'ReportController@getStockDetails');
    Route::get('/reports/tax-report', 'ReportController@getTaxReport');
    Route::get('/reports/tax-details', 'ReportController@getTaxDetails');
    Route::get('/reports/trending-products', 'ReportController@getTrendingProducts');
    Route::get('/reports/expense-report', 'ReportController@getExpenseReport');
    Route::get('/reports/stock-adjustment-report', 'ReportController@getStockAdjustmentReport');
    Route::get('/reports/register-report', 'ReportController@getRegisterReport');
    Route::get('/reports/sales-representative-report', 'ReportController@getSalesRepresentativeReport');
    Route::get('/reports/sales-representative-total-expense', 'ReportController@getSalesRepresentativeTotalExpense');
    Route::get('/reports/sales-representative-total-sell', 'ReportController@getSalesRepresentativeTotalSell');
    Route::get('/reports/sales-representative-total-commission', 'ReportController@getSalesRepresentativeTotalCommission');
    Route::get('/reports/stock-expiry', 'ReportController@getStockExpiryReport');
    Route::get('/reports/stock-expiry-edit-modal/{purchase_line_id}', 'ReportController@getStockExpiryReportEditModal');
    Route::post('/reports/stock-expiry-update', 'ReportController@updateStockExpiryReport')->name('updateStockExpiryReport');
    Route::get('/reports/customer-group', 'ReportController@getCustomerGroup');
    Route::get('/reports/product-purchase-report', 'ReportController@getproductPurchaseReport');
    Route::get('/reports/product-sell-report', 'ReportController@getproductSellReport');
    Route::get('/reports/product-sell-report-with-purchase', 'ReportController@getproductSellReportWithPurchase');
    Route::get('/reports/product-sell-grouped-report', 'ReportController@getproductSellGroupedReport');
    Route::get('/reports/lot-report', 'ReportController@getLotReport');
    Route::get('/reports/purchase-payment-report', 'ReportController@purchasePaymentReport');
    Route::get('/reports/sell-payment-report', 'ReportController@sellPaymentReport');
    Route::get('/reports/product-stock-details', 'ReportController@productStockDetails');
    Route::get('/reports/adjust-product-stock', 'ReportController@adjustProductStock');
    Route::get('/reports/get-profit/{by?}', 'ReportController@getProfit');
    Route::get('/reports/items-report', 'ReportController@itemsReport');
    Route::get('/reports/get-stock-value', 'ReportController@getStockValue');
    
    Route::get('business-location/activate-deactivate/{location_id}', 'BusinessLocationController@activateDeactivateLocation');

    // Business Location Settings...
    Route::prefix('business-location/{location_id}')->name('location.')->group(function () {
        Route::get('settings', 'LocationSettingsController@index')->name('settings');
        Route::post('settings', 'LocationSettingsController@updateSettings')->name('settings_update');
    });

    // Business Locations...
    Route::post('business-location/check-location-id', 'BusinessLocationController@checkLocationId');
    Route::resource('business-location', 'BusinessLocationController');

    // Invoice layouts..
    Route::resource('invoice-layouts', 'InvoiceLayoutController');

    // Expense Categories...
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Expenses...
    Route::resource('expenses', 'ExpenseController');

    // Transaction payments...
    Route::get('/payments/show-child-payments/{payment_id}', 'TransactionPaymentController@showChildPayments');
    Route::get('/payments/view-payment/{payment_id}', 'TransactionPaymentController@viewPayment');
    Route::get('/payments/add_payment/{transaction_id}', 'TransactionPaymentController@addPayment');
    Route::get('/payments/pay-contact-due/{contact_id}', 'TransactionPaymentController@getPayContactDue');
    Route::post('/payments/pay-contact-due', 'TransactionPaymentController@postPayContactDue');
    Route::resource('payments', 'TransactionPaymentController');

    // Printers...
    Route::resource('printers', 'PrinterController');

    Route::get('/stock-adjustments/remove-expired-stock/{purchase_line_id}', 'StockAdjustmentController@removeExpiredStock');
    Route::post('/stock-adjustments/get_product_row', 'StockAdjustmentController@getProductRow');
    Route::resource('stock-adjustments', 'StockAdjustmentController');

    Route::get('/cash-register/register-details', 'CashRegisterController@getRegisterDetails');
    Route::get('/cash-register/close-register/{id?}', 'CashRegisterController@getCloseRegister');
    Route::post('/cash-register/close-register', 'CashRegisterController@postCloseRegister');
    Route::resource('cash-register', 'CashRegisterController');

    // Import products
    Route::get('/import-products', 'ImportProductsController@index')->name('import-products-index');
    Route::post('/import-products/store', 'ImportProductsController@store');

    // Sales Commission Agent
    Route::resource('sales-commission-agents', 'SalesCommissionAgentController');

    // Stock Transfer
    Route::get('stock-transfers/print/{id}', 'StockTransferController@printInvoice');
    Route::post('stock-transfers/update-status/{id}', 'StockTransferController@updateStatus');
    Route::resource('stock-transfers', 'StockTransferController');
    
    Route::get('/opening-stock/add/{product_id}', 'OpeningStockController@add');
    Route::post('/opening-stock/save', 'OpeningStockController@save');

    // Customer Groups
    Route::resource('customer-group', 'CustomerGroupController');

    // Import opening stock
    Route::get('/import-opening-stock', 'ImportOpeningStockController@index')->name('import-opening-stock-index');
    Route::post('/import-opening-stock/store', 'ImportOpeningStockController@store');

    // Sell return
    Route::resource('sell-return', 'SellReturnController');
    Route::get('sell-return/get-product-row', 'SellReturnController@getProductRow');
    Route::get('/sell-return/print/{id}', 'SellReturnController@printInvoice');
    Route::get('/sell-return/add/{id}', 'SellReturnController@add');
    
    // Backup
    Route::get('backup/download/{file_name}', 'BackUpController@download');
    Route::get('backup/delete/{file_name}', 'BackUpController@delete');
    Route::resource('backup', 'BackUpController', ['only' => [
        'index', 'create', 'store'
    ]]);

    Route::get('selling-price-group/activate-deactivate/{id}', 'SellingPriceGroupController@activateDeactivate');
    Route::get('export-selling-price-group', 'SellingPriceGroupController@export');
    Route::post('import-selling-price-group', 'SellingPriceGroupController@import');

    Route::resource('selling-price-group', 'SellingPriceGroupController');

    Route::resource('notification-templates', 'NotificationTemplateController')->only(['index', 'store']);
    Route::get('notification/get-template/{transaction_id}/{template_for}', 'NotificationController@getTemplate');
    Route::post('notification/send', 'NotificationController@send');

    Route::post('/purchase-return/update', 'CombinedPurchaseReturnController@update');
    Route::get('/purchase-return/edit/{id}', 'CombinedPurchaseReturnController@edit');
    Route::post('/purchase-return/save', 'CombinedPurchaseReturnController@save');
    Route::post('/purchase-return/get_product_row', 'CombinedPurchaseReturnController@getProductRow');
    Route::get('/purchase-return/create', 'CombinedPurchaseReturnController@create');
    Route::get('/purchase-return/add/{id}', 'PurchaseReturnController@add');
    Route::resource('/purchase-return', 'PurchaseReturnController', ['except' => ['create']]);

    Route::get('/discount/activate/{id}', 'DiscountController@activate');
    Route::post('/discount/mass-deactivate', 'DiscountController@massDeactivate');
    Route::resource('discount', 'DiscountController');

    Route::group(['prefix' => 'account'], function () {
        Route::resource('/account', 'AccountController');
        Route::get('/fund-transfer/{id}', 'AccountController@getFundTransfer');
        Route::post('/fund-transfer', 'AccountController@postFundTransfer');
        Route::get('/deposit/{id}', 'AccountController@getDeposit');
        Route::post('/deposit', 'AccountController@postDeposit');
        Route::get('/close/{id}', 'AccountController@close');
        Route::get('/activate/{id}', 'AccountController@activate');
        Route::get('/delete-account-transaction/{id}', 'AccountController@destroyAccountTransaction');
        Route::get('/get-account-balance/{id}', 'AccountController@getAccountBalance');
        Route::get('/balance-sheet', 'AccountReportsController@balanceSheet');
    	Route::get('/balance-sheet1', 'AccountReportsController@balanceSheet1');
        Route::get('/trial-balance', 'AccountReportsController@trialBalance');
        Route::get('/payment-account-report', 'AccountReportsController@paymentAccountReport');
        Route::get('/link-account/{id}', 'AccountReportsController@getLinkAccount');
        Route::post('/link-account', 'AccountReportsController@postLinkAccount');
        Route::get('/cash-flow', 'AccountController@cashFlow');
    });
    
    Route::resource('account-types', 'AccountTypeController');

    // Restaurant module
    Route::group(['prefix' => 'modules'], function () {
        Route::resource('tables', 'Restaurant\TableController');
        Route::resource('modifiers', 'Restaurant\ModifierSetsController');
        Route::get('/product-modifiers/{id}/edit', 'Restaurant\ProductModifierSetController@edit');
        Route::post('/product-modifiers/{id}/update', 'Restaurant\ProductModifierSetController@update');
        Route::get('/product-modifiers/product-row/{product_id}', 'Restaurant\ProductModifierSetController@product_row');
        Route::get('/add-selected-modifiers', 'Restaurant\ProductModifierSetController@add_selected_modifiers');
        Route::get('/kitchen', 'Restaurant\KitchenController@index');
        Route::get('/kitchen/mark-as-cooked/{id}', 'Restaurant\KitchenController@markAsCooked');
        Route::get('/kitchen/mark-as-cooked-all', 'Restaurant\KitchenController@markAsCookedAll');
        Route::post('/refresh-orders-list', 'Restaurant\KitchenController@refreshOrdersList');
        Route::post('/refresh-line-orders-list', 'Restaurant\KitchenController@refreshLineOrdersList');
        Route::get('/orders', 'Restaurant\OrderController@index');
        Route::get('/orders/mark-as-served/{id}', 'Restaurant\OrderController@markAsServed');
        Route::get('/data/get-pos-details', 'Restaurant\DataController@getPosDetails');
        Route::get('/orders/mark-line-order-as-served/{id}', 'Restaurant\OrderController@markLineOrderAsServed');
        Route::get('/print-line-order', 'Restaurant\OrderController@printLineOrder');
    });

    Route::get('bookings/get-todays-bookings', 'Restaurant\BookingController@getTodaysBookings');
    Route::resource('bookings', 'Restaurant\BookingController');
    
    Route::resource('types-of-service', 'TypesOfServiceController');
    Route::get('sells/edit-shipping/{id}', 'SellController@editShipping');
    Route::put('sells/update-shipping/{id}', 'SellController@updateShipping');
    Route::get('shipments', 'SellController@shipments');

    Route::post('upload-module', 'Install\ModulesController@uploadModule');
    Route::resource('manage-modules', 'Install\ModulesController')
        ->only(['index', 'destroy', 'update']);
    Route::resource('warranties', 'WarrantyController');

    Route::resource('dashboard-configurator', 'DashboardConfiguratorController')
    ->only(['edit', 'update']);

    Route::get('view-media/{model_id}', 'SellController@viewMedia');

    //common controller for document & note
    Route::get('get-document-note-page', 'DocumentAndNoteController@getDocAndNoteIndexPage');
    Route::post('post-document-upload', 'DocumentAndNoteController@postMedia');
    Route::resource('note-documents', 'DocumentAndNoteController');
    Route::resource('purchase-order', 'PurchaseOrderController');
    Route::get('get-purchase-orders/{contact_id}', 'PurchaseOrderController@getPurchaseOrders');
    Route::get('get-purchase-order-lines/{purchase_order_id}', 'PurchaseController@getPurchaseOrderLines');
    Route::get('edit-purchase-orders/{id}/status', 'PurchaseOrderController@getEditPurchaseOrderStatus');
    Route::put('update-purchase-orders/{id}/status', 'PurchaseOrderController@postEditPurchaseOrderStatus');
    Route::resource('sales-order', 'SalesOrderController')->only(['index']);
    Route::get('get-sales-orders/{customer_id}', 'SalesOrderController@getSalesOrders');
    Route::get('get-sales-order-lines', 'SellPosController@getSalesOrderLines');
    Route::get('edit-sales-orders/{id}/status', 'SalesOrderController@getEditSalesOrderStatus');
    Route::put('update-sales-orders/{id}/status', 'SalesOrderController@postEditSalesOrderStatus');
    Route::get('reports/activity-log', 'ReportController@activityLog');
});

Route::middleware(['EcomApi'])->prefix('api/ecom')->group(function () {
    Route::get('products/{id?}', 'ProductController@getProductsApi');
    Route::get('categories', 'CategoryController@getCategoriesApi');
    Route::get('brands', 'BrandController@getBrandsApi');
    Route::post('customers', 'ContactController@postCustomersApi');
    Route::get('settings', 'BusinessController@getEcomSettings');
    Route::get('variations', 'ProductController@getVariationsApi');
    Route::post('orders', 'SellPosController@placeOrdersApi');
});

//common route
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone'])->group(function () {
    Route::get('/load-more-notifications', 'HomeController@loadMoreNotifications');
    Route::get('/get-total-unread', 'HomeController@getTotalUnreadNotifications');
    Route::get('/purchases/print/{id}', 'PurchaseController@printInvoice');
    Route::get('/purchases/{id}', 'PurchaseController@show');
    Route::get('/download-purchase-order/{id}/pdf', 'PurchaseOrderController@downloadPdf')->name('purchaseOrder.downloadPdf');
    Route::get('/sells/{id}', 'SellController@show');
    Route::get('/sells/{transaction_id}/print', 'SellPosController@printInvoice')->name('sell.printInvoice');
    Route::get('/download-sells/{transaction_id}/pdf', 'SellPosController@downloadPdf')->name('sell.downloadPdf');
    Route::get('/download-quotation/{id}/pdf', 'SellPosController@downloadQuotationPdf')
        ->name('quotation.downloadPdf');
    Route::get('/download-packing-list/{id}/pdf', 'SellPosController@downloadPackingListPdf')
        ->name('packing.downloadPdf');
    Route::get('/sells/invoice-url/{id}', 'SellPosController@showInvoiceUrl');
    Route::get('/show-notification/{id}', 'HomeController@showNotification');
});
