<?php

namespace PHPMaker2022\sigap;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // absen
    $app->map(["GET","POST","OPTIONS"], '/AbsenList[/{id}]', AbsenController::class . ':list')->add(PermissionMiddleware::class)->setName('AbsenList-absen-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AbsenAdd[/{id}]', AbsenController::class . ':add')->add(PermissionMiddleware::class)->setName('AbsenAdd-absen-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AbsenView[/{id}]', AbsenController::class . ':view')->add(PermissionMiddleware::class)->setName('AbsenView-absen-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AbsenEdit[/{id}]', AbsenController::class . ':edit')->add(PermissionMiddleware::class)->setName('AbsenEdit-absen-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AbsenDelete[/{id}]', AbsenController::class . ':delete')->add(PermissionMiddleware::class)->setName('AbsenDelete-absen-delete'); // delete
    $app->group(
        '/absen',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AbsenController::class . ':list')->add(PermissionMiddleware::class)->setName('absen/list-absen-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AbsenController::class . ':add')->add(PermissionMiddleware::class)->setName('absen/add-absen-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AbsenController::class . ':view')->add(PermissionMiddleware::class)->setName('absen/view-absen-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AbsenController::class . ':edit')->add(PermissionMiddleware::class)->setName('absen/edit-absen-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AbsenController::class . ':delete')->add(PermissionMiddleware::class)->setName('absen/delete-absen-delete-2'); // delete
        }
    );

    // absen_detil
    $app->map(["GET","POST","OPTIONS"], '/AbsenDetilList[/{id}]', AbsenDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('AbsenDetilList-absen_detil-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AbsenDetilAdd[/{id}]', AbsenDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('AbsenDetilAdd-absen_detil-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AbsenDetilView[/{id}]', AbsenDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('AbsenDetilView-absen_detil-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AbsenDetilEdit[/{id}]', AbsenDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('AbsenDetilEdit-absen_detil-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AbsenDetilDelete[/{id}]', AbsenDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('AbsenDetilDelete-absen_detil-delete'); // delete
    $app->map(["GET","OPTIONS"], '/AbsenDetilPreview', AbsenDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('AbsenDetilPreview-absen_detil-preview'); // preview
    $app->group(
        '/absen_detil',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AbsenDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('absen_detil/list-absen_detil-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AbsenDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('absen_detil/add-absen_detil-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AbsenDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('absen_detil/view-absen_detil-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AbsenDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('absen_detil/edit-absen_detil-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AbsenDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('absen_detil/delete-absen_detil-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', AbsenDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('absen_detil/preview-absen_detil-preview-2'); // preview
        }
    );

    // audittrail
    $app->map(["GET","POST","OPTIONS"], '/AudittrailList[/{id}]', AudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('AudittrailList-audittrail-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AudittrailAdd[/{id}]', AudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('AudittrailAdd-audittrail-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AudittrailView[/{id}]', AudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('AudittrailView-audittrail-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AudittrailEdit[/{id}]', AudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('AudittrailEdit-audittrail-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AudittrailDelete[/{id}]', AudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('AudittrailDelete-audittrail-delete'); // delete
    $app->group(
        '/audittrail',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('audittrail/list-audittrail-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('audittrail/add-audittrail-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('audittrail/view-audittrail-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('audittrail/edit-audittrail-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('audittrail/delete-audittrail-delete-2'); // delete
        }
    );

    // berita
    $app->map(["GET","POST","OPTIONS"], '/BeritaList[/{id}]', BeritaController::class . ':list')->add(PermissionMiddleware::class)->setName('BeritaList-berita-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/BeritaAdd[/{id}]', BeritaController::class . ':add')->add(PermissionMiddleware::class)->setName('BeritaAdd-berita-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/BeritaView[/{id}]', BeritaController::class . ':view')->add(PermissionMiddleware::class)->setName('BeritaView-berita-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/BeritaEdit[/{id}]', BeritaController::class . ':edit')->add(PermissionMiddleware::class)->setName('BeritaEdit-berita-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/BeritaDelete[/{id}]', BeritaController::class . ':delete')->add(PermissionMiddleware::class)->setName('BeritaDelete-berita-delete'); // delete
    $app->group(
        '/berita',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', BeritaController::class . ':list')->add(PermissionMiddleware::class)->setName('berita/list-berita-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', BeritaController::class . ':add')->add(PermissionMiddleware::class)->setName('berita/add-berita-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', BeritaController::class . ':view')->add(PermissionMiddleware::class)->setName('berita/view-berita-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', BeritaController::class . ':edit')->add(PermissionMiddleware::class)->setName('berita/edit-berita-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', BeritaController::class . ':delete')->add(PermissionMiddleware::class)->setName('berita/delete-berita-delete-2'); // delete
        }
    );

    // daftarbarang
    $app->map(["GET","POST","OPTIONS"], '/DaftarbarangList[/{id}]', DaftarbarangController::class . ':list')->add(PermissionMiddleware::class)->setName('DaftarbarangList-daftarbarang-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DaftarbarangAdd[/{id}]', DaftarbarangController::class . ':add')->add(PermissionMiddleware::class)->setName('DaftarbarangAdd-daftarbarang-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DaftarbarangView[/{id}]', DaftarbarangController::class . ':view')->add(PermissionMiddleware::class)->setName('DaftarbarangView-daftarbarang-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DaftarbarangEdit[/{id}]', DaftarbarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('DaftarbarangEdit-daftarbarang-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DaftarbarangDelete[/{id}]', DaftarbarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('DaftarbarangDelete-daftarbarang-delete'); // delete
    $app->group(
        '/daftarbarang',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', DaftarbarangController::class . ':list')->add(PermissionMiddleware::class)->setName('daftarbarang/list-daftarbarang-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', DaftarbarangController::class . ':add')->add(PermissionMiddleware::class)->setName('daftarbarang/add-daftarbarang-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', DaftarbarangController::class . ':view')->add(PermissionMiddleware::class)->setName('daftarbarang/view-daftarbarang-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', DaftarbarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('daftarbarang/edit-daftarbarang-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', DaftarbarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('daftarbarang/delete-daftarbarang-delete-2'); // delete
        }
    );

    // dinasluar
    $app->map(["GET","POST","OPTIONS"], '/DinasluarList[/{id}]', DinasluarController::class . ':list')->add(PermissionMiddleware::class)->setName('DinasluarList-dinasluar-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DinasluarAdd[/{id}]', DinasluarController::class . ':add')->add(PermissionMiddleware::class)->setName('DinasluarAdd-dinasluar-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/DinasluarView[/{id}]', DinasluarController::class . ':view')->add(PermissionMiddleware::class)->setName('DinasluarView-dinasluar-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DinasluarEdit[/{id}]', DinasluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('DinasluarEdit-dinasluar-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DinasluarDelete[/{id}]', DinasluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('DinasluarDelete-dinasluar-delete'); // delete
    $app->group(
        '/dinasluar',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', DinasluarController::class . ':list')->add(PermissionMiddleware::class)->setName('dinasluar/list-dinasluar-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', DinasluarController::class . ':add')->add(PermissionMiddleware::class)->setName('dinasluar/add-dinasluar-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', DinasluarController::class . ':view')->add(PermissionMiddleware::class)->setName('dinasluar/view-dinasluar-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', DinasluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('dinasluar/edit-dinasluar-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', DinasluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('dinasluar/delete-dinasluar-delete-2'); // delete
        }
    );

    // gajitunjangan
    $app->map(["GET","POST","OPTIONS"], '/GajitunjanganList[/{id}]', GajitunjanganController::class . ':list')->add(PermissionMiddleware::class)->setName('GajitunjanganList-gajitunjangan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajitunjanganAdd[/{id}]', GajitunjanganController::class . ':add')->add(PermissionMiddleware::class)->setName('GajitunjanganAdd-gajitunjangan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajitunjanganView[/{id}]', GajitunjanganController::class . ':view')->add(PermissionMiddleware::class)->setName('GajitunjanganView-gajitunjangan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajitunjanganEdit[/{id}]', GajitunjanganController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajitunjanganEdit-gajitunjangan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajitunjanganDelete[/{id}]', GajitunjanganController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajitunjanganDelete-gajitunjangan-delete'); // delete
    $app->map(["GET","OPTIONS"], '/GajitunjanganPreview', GajitunjanganController::class . ':preview')->add(PermissionMiddleware::class)->setName('GajitunjanganPreview-gajitunjangan-preview'); // preview
    $app->group(
        '/gajitunjangan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajitunjanganController::class . ':list')->add(PermissionMiddleware::class)->setName('gajitunjangan/list-gajitunjangan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajitunjanganController::class . ':add')->add(PermissionMiddleware::class)->setName('gajitunjangan/add-gajitunjangan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajitunjanganController::class . ':view')->add(PermissionMiddleware::class)->setName('gajitunjangan/view-gajitunjangan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajitunjanganController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajitunjangan/edit-gajitunjangan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajitunjanganController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajitunjangan/delete-gajitunjangan-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', GajitunjanganController::class . ':preview')->add(PermissionMiddleware::class)->setName('gajitunjangan/preview-gajitunjangan-preview-2'); // preview
        }
    );

    // ijin
    $app->map(["GET","POST","OPTIONS"], '/IjinList[/{id}]', IjinController::class . ':list')->add(PermissionMiddleware::class)->setName('IjinList-ijin-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/IjinAdd[/{id}]', IjinController::class . ':add')->add(PermissionMiddleware::class)->setName('IjinAdd-ijin-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/IjinView[/{id}]', IjinController::class . ':view')->add(PermissionMiddleware::class)->setName('IjinView-ijin-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/IjinEdit[/{id}]', IjinController::class . ':edit')->add(PermissionMiddleware::class)->setName('IjinEdit-ijin-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/IjinDelete[/{id}]', IjinController::class . ':delete')->add(PermissionMiddleware::class)->setName('IjinDelete-ijin-delete'); // delete
    $app->group(
        '/ijin',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', IjinController::class . ':list')->add(PermissionMiddleware::class)->setName('ijin/list-ijin-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', IjinController::class . ':add')->add(PermissionMiddleware::class)->setName('ijin/add-ijin-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', IjinController::class . ':view')->add(PermissionMiddleware::class)->setName('ijin/view-ijin-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', IjinController::class . ':edit')->add(PermissionMiddleware::class)->setName('ijin/edit-ijin-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', IjinController::class . ':delete')->add(PermissionMiddleware::class)->setName('ijin/delete-ijin-delete-2'); // delete
        }
    );

    // jabatan
    $app->map(["GET","POST","OPTIONS"], '/JabatanList[/{id}]', JabatanController::class . ':list')->add(PermissionMiddleware::class)->setName('JabatanList-jabatan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JabatanAdd[/{id}]', JabatanController::class . ':add')->add(PermissionMiddleware::class)->setName('JabatanAdd-jabatan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JabatanView[/{id}]', JabatanController::class . ':view')->add(PermissionMiddleware::class)->setName('JabatanView-jabatan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JabatanEdit[/{id}]', JabatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('JabatanEdit-jabatan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JabatanDelete[/{id}]', JabatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('JabatanDelete-jabatan-delete'); // delete
    $app->group(
        '/jabatan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JabatanController::class . ':list')->add(PermissionMiddleware::class)->setName('jabatan/list-jabatan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JabatanController::class . ':add')->add(PermissionMiddleware::class)->setName('jabatan/add-jabatan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JabatanController::class . ':view')->add(PermissionMiddleware::class)->setName('jabatan/view-jabatan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JabatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('jabatan/edit-jabatan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JabatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('jabatan/delete-jabatan-delete-2'); // delete
        }
    );

    // jenis_barang
    $app->map(["GET","POST","OPTIONS"], '/JenisBarangList[/{id}]', JenisBarangController::class . ':list')->add(PermissionMiddleware::class)->setName('JenisBarangList-jenis_barang-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JenisBarangAdd[/{id}]', JenisBarangController::class . ':add')->add(PermissionMiddleware::class)->setName('JenisBarangAdd-jenis_barang-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JenisBarangView[/{id}]', JenisBarangController::class . ':view')->add(PermissionMiddleware::class)->setName('JenisBarangView-jenis_barang-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JenisBarangEdit[/{id}]', JenisBarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('JenisBarangEdit-jenis_barang-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JenisBarangDelete[/{id}]', JenisBarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('JenisBarangDelete-jenis_barang-delete'); // delete
    $app->group(
        '/jenis_barang',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JenisBarangController::class . ':list')->add(PermissionMiddleware::class)->setName('jenis_barang/list-jenis_barang-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JenisBarangController::class . ':add')->add(PermissionMiddleware::class)->setName('jenis_barang/add-jenis_barang-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JenisBarangController::class . ':view')->add(PermissionMiddleware::class)->setName('jenis_barang/view-jenis_barang-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JenisBarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('jenis_barang/edit-jenis_barang-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JenisBarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('jenis_barang/delete-jenis_barang-delete-2'); // delete
        }
    );

    // jenis_dinasluar
    $app->map(["GET","POST","OPTIONS"], '/JenisDinasluarList[/{id}]', JenisDinasluarController::class . ':list')->add(PermissionMiddleware::class)->setName('JenisDinasluarList-jenis_dinasluar-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JenisDinasluarAdd[/{id}]', JenisDinasluarController::class . ':add')->add(PermissionMiddleware::class)->setName('JenisDinasluarAdd-jenis_dinasluar-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JenisDinasluarView[/{id}]', JenisDinasluarController::class . ':view')->add(PermissionMiddleware::class)->setName('JenisDinasluarView-jenis_dinasluar-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JenisDinasluarEdit[/{id}]', JenisDinasluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('JenisDinasluarEdit-jenis_dinasluar-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JenisDinasluarDelete[/{id}]', JenisDinasluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('JenisDinasluarDelete-jenis_dinasluar-delete'); // delete
    $app->group(
        '/jenis_dinasluar',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JenisDinasluarController::class . ':list')->add(PermissionMiddleware::class)->setName('jenis_dinasluar/list-jenis_dinasluar-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JenisDinasluarController::class . ':add')->add(PermissionMiddleware::class)->setName('jenis_dinasluar/add-jenis_dinasluar-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JenisDinasluarController::class . ':view')->add(PermissionMiddleware::class)->setName('jenis_dinasluar/view-jenis_dinasluar-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JenisDinasluarController::class . ':edit')->add(PermissionMiddleware::class)->setName('jenis_dinasluar/edit-jenis_dinasluar-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JenisDinasluarController::class . ':delete')->add(PermissionMiddleware::class)->setName('jenis_dinasluar/delete-jenis_dinasluar-delete-2'); // delete
        }
    );

    // jenis_grup_berita
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupBeritaList[/{id}]', JenisGrupBeritaController::class . ':list')->add(PermissionMiddleware::class)->setName('JenisGrupBeritaList-jenis_grup_berita-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupBeritaAdd[/{id}]', JenisGrupBeritaController::class . ':add')->add(PermissionMiddleware::class)->setName('JenisGrupBeritaAdd-jenis_grup_berita-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupBeritaView[/{id}]', JenisGrupBeritaController::class . ':view')->add(PermissionMiddleware::class)->setName('JenisGrupBeritaView-jenis_grup_berita-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupBeritaEdit[/{id}]', JenisGrupBeritaController::class . ':edit')->add(PermissionMiddleware::class)->setName('JenisGrupBeritaEdit-jenis_grup_berita-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupBeritaDelete[/{id}]', JenisGrupBeritaController::class . ':delete')->add(PermissionMiddleware::class)->setName('JenisGrupBeritaDelete-jenis_grup_berita-delete'); // delete
    $app->group(
        '/jenis_grup_berita',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JenisGrupBeritaController::class . ':list')->add(PermissionMiddleware::class)->setName('jenis_grup_berita/list-jenis_grup_berita-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JenisGrupBeritaController::class . ':add')->add(PermissionMiddleware::class)->setName('jenis_grup_berita/add-jenis_grup_berita-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JenisGrupBeritaController::class . ':view')->add(PermissionMiddleware::class)->setName('jenis_grup_berita/view-jenis_grup_berita-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JenisGrupBeritaController::class . ':edit')->add(PermissionMiddleware::class)->setName('jenis_grup_berita/edit-jenis_grup_berita-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JenisGrupBeritaController::class . ':delete')->add(PermissionMiddleware::class)->setName('jenis_grup_berita/delete-jenis_grup_berita-delete-2'); // delete
        }
    );

    // jenis_grup_ilmu
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupIlmuList[/{id}]', JenisGrupIlmuController::class . ':list')->add(PermissionMiddleware::class)->setName('JenisGrupIlmuList-jenis_grup_ilmu-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupIlmuAdd[/{id}]', JenisGrupIlmuController::class . ':add')->add(PermissionMiddleware::class)->setName('JenisGrupIlmuAdd-jenis_grup_ilmu-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupIlmuView[/{id}]', JenisGrupIlmuController::class . ':view')->add(PermissionMiddleware::class)->setName('JenisGrupIlmuView-jenis_grup_ilmu-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupIlmuEdit[/{id}]', JenisGrupIlmuController::class . ':edit')->add(PermissionMiddleware::class)->setName('JenisGrupIlmuEdit-jenis_grup_ilmu-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JenisGrupIlmuDelete[/{id}]', JenisGrupIlmuController::class . ':delete')->add(PermissionMiddleware::class)->setName('JenisGrupIlmuDelete-jenis_grup_ilmu-delete'); // delete
    $app->group(
        '/jenis_grup_ilmu',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JenisGrupIlmuController::class . ':list')->add(PermissionMiddleware::class)->setName('jenis_grup_ilmu/list-jenis_grup_ilmu-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JenisGrupIlmuController::class . ':add')->add(PermissionMiddleware::class)->setName('jenis_grup_ilmu/add-jenis_grup_ilmu-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JenisGrupIlmuController::class . ':view')->add(PermissionMiddleware::class)->setName('jenis_grup_ilmu/view-jenis_grup_ilmu-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JenisGrupIlmuController::class . ':edit')->add(PermissionMiddleware::class)->setName('jenis_grup_ilmu/edit-jenis_grup_ilmu-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JenisGrupIlmuController::class . ':delete')->add(PermissionMiddleware::class)->setName('jenis_grup_ilmu/delete-jenis_grup_ilmu-delete-2'); // delete
        }
    );

    // jenis_ijin
    $app->map(["GET","POST","OPTIONS"], '/JenisIjinList[/{id}]', JenisIjinController::class . ':list')->add(PermissionMiddleware::class)->setName('JenisIjinList-jenis_ijin-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JenisIjinAdd[/{id}]', JenisIjinController::class . ':add')->add(PermissionMiddleware::class)->setName('JenisIjinAdd-jenis_ijin-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JenisIjinView[/{id}]', JenisIjinController::class . ':view')->add(PermissionMiddleware::class)->setName('JenisIjinView-jenis_ijin-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JenisIjinEdit[/{id}]', JenisIjinController::class . ':edit')->add(PermissionMiddleware::class)->setName('JenisIjinEdit-jenis_ijin-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JenisIjinDelete[/{id}]', JenisIjinController::class . ':delete')->add(PermissionMiddleware::class)->setName('JenisIjinDelete-jenis_ijin-delete'); // delete
    $app->group(
        '/jenis_ijin',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JenisIjinController::class . ':list')->add(PermissionMiddleware::class)->setName('jenis_ijin/list-jenis_ijin-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JenisIjinController::class . ':add')->add(PermissionMiddleware::class)->setName('jenis_ijin/add-jenis_ijin-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JenisIjinController::class . ':view')->add(PermissionMiddleware::class)->setName('jenis_ijin/view-jenis_ijin-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JenisIjinController::class . ':edit')->add(PermissionMiddleware::class)->setName('jenis_ijin/edit-jenis_ijin-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JenisIjinController::class . ':delete')->add(PermissionMiddleware::class)->setName('jenis_ijin/delete-jenis_ijin-delete-2'); // delete
        }
    );

    // jenis_lembur
    $app->map(["GET","POST","OPTIONS"], '/JenisLemburList[/{id}]', JenisLemburController::class . ':list')->add(PermissionMiddleware::class)->setName('JenisLemburList-jenis_lembur-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JenisLemburAdd[/{id}]', JenisLemburController::class . ':add')->add(PermissionMiddleware::class)->setName('JenisLemburAdd-jenis_lembur-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/JenisLemburView[/{id}]', JenisLemburController::class . ':view')->add(PermissionMiddleware::class)->setName('JenisLemburView-jenis_lembur-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JenisLemburEdit[/{id}]', JenisLemburController::class . ':edit')->add(PermissionMiddleware::class)->setName('JenisLemburEdit-jenis_lembur-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JenisLemburDelete[/{id}]', JenisLemburController::class . ':delete')->add(PermissionMiddleware::class)->setName('JenisLemburDelete-jenis_lembur-delete'); // delete
    $app->group(
        '/jenis_lembur',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JenisLemburController::class . ':list')->add(PermissionMiddleware::class)->setName('jenis_lembur/list-jenis_lembur-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JenisLemburController::class . ':add')->add(PermissionMiddleware::class)->setName('jenis_lembur/add-jenis_lembur-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JenisLemburController::class . ':view')->add(PermissionMiddleware::class)->setName('jenis_lembur/view-jenis_lembur-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', JenisLemburController::class . ':edit')->add(PermissionMiddleware::class)->setName('jenis_lembur/edit-jenis_lembur-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JenisLemburController::class . ':delete')->add(PermissionMiddleware::class)->setName('jenis_lembur/delete-jenis_lembur-delete-2'); // delete
        }
    );

    // komentar
    $app->map(["GET","POST","OPTIONS"], '/KomentarList[/{id}]', KomentarController::class . ':list')->add(PermissionMiddleware::class)->setName('KomentarList-komentar-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KomentarAdd[/{id}]', KomentarController::class . ':add')->add(PermissionMiddleware::class)->setName('KomentarAdd-komentar-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/KomentarView[/{id}]', KomentarController::class . ':view')->add(PermissionMiddleware::class)->setName('KomentarView-komentar-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KomentarEdit[/{id}]', KomentarController::class . ':edit')->add(PermissionMiddleware::class)->setName('KomentarEdit-komentar-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KomentarDelete[/{id}]', KomentarController::class . ':delete')->add(PermissionMiddleware::class)->setName('KomentarDelete-komentar-delete'); // delete
    $app->map(["GET","OPTIONS"], '/KomentarPreview', KomentarController::class . ':preview')->add(PermissionMiddleware::class)->setName('KomentarPreview-komentar-preview'); // preview
    $app->group(
        '/komentar',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', KomentarController::class . ':list')->add(PermissionMiddleware::class)->setName('komentar/list-komentar-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', KomentarController::class . ':add')->add(PermissionMiddleware::class)->setName('komentar/add-komentar-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', KomentarController::class . ':view')->add(PermissionMiddleware::class)->setName('komentar/view-komentar-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', KomentarController::class . ':edit')->add(PermissionMiddleware::class)->setName('komentar/edit-komentar-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', KomentarController::class . ':delete')->add(PermissionMiddleware::class)->setName('komentar/delete-komentar-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', KomentarController::class . ':preview')->add(PermissionMiddleware::class)->setName('komentar/preview-komentar-preview-2'); // preview
        }
    );

    // lembur
    $app->map(["GET","POST","OPTIONS"], '/LemburList[/{id}]', LemburController::class . ':list')->add(PermissionMiddleware::class)->setName('LemburList-lembur-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/LemburAdd[/{id}]', LemburController::class . ':add')->add(PermissionMiddleware::class)->setName('LemburAdd-lembur-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/LemburView[/{id}]', LemburController::class . ':view')->add(PermissionMiddleware::class)->setName('LemburView-lembur-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/LemburEdit[/{id}]', LemburController::class . ':edit')->add(PermissionMiddleware::class)->setName('LemburEdit-lembur-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/LemburDelete[/{id}]', LemburController::class . ':delete')->add(PermissionMiddleware::class)->setName('LemburDelete-lembur-delete'); // delete
    $app->group(
        '/lembur',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', LemburController::class . ':list')->add(PermissionMiddleware::class)->setName('lembur/list-lembur-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', LemburController::class . ':add')->add(PermissionMiddleware::class)->setName('lembur/add-lembur-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', LemburController::class . ':view')->add(PermissionMiddleware::class)->setName('lembur/view-lembur-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', LemburController::class . ':edit')->add(PermissionMiddleware::class)->setName('lembur/edit-lembur-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', LemburController::class . ':delete')->add(PermissionMiddleware::class)->setName('lembur/delete-lembur-delete-2'); // delete
        }
    );

    // peg_dokumen
    $app->map(["GET","POST","OPTIONS"], '/PegDokumenList[/{id}]', PegDokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('PegDokumenList-peg_dokumen-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PegDokumenAdd[/{id}]', PegDokumenController::class . ':add')->add(PermissionMiddleware::class)->setName('PegDokumenAdd-peg_dokumen-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PegDokumenView[/{id}]', PegDokumenController::class . ':view')->add(PermissionMiddleware::class)->setName('PegDokumenView-peg_dokumen-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PegDokumenEdit[/{id}]', PegDokumenController::class . ':edit')->add(PermissionMiddleware::class)->setName('PegDokumenEdit-peg_dokumen-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PegDokumenDelete[/{id}]', PegDokumenController::class . ':delete')->add(PermissionMiddleware::class)->setName('PegDokumenDelete-peg_dokumen-delete'); // delete
    $app->map(["GET","OPTIONS"], '/PegDokumenPreview', PegDokumenController::class . ':preview')->add(PermissionMiddleware::class)->setName('PegDokumenPreview-peg_dokumen-preview'); // preview
    $app->group(
        '/peg_dokumen',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PegDokumenController::class . ':list')->add(PermissionMiddleware::class)->setName('peg_dokumen/list-peg_dokumen-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PegDokumenController::class . ':add')->add(PermissionMiddleware::class)->setName('peg_dokumen/add-peg_dokumen-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PegDokumenController::class . ':view')->add(PermissionMiddleware::class)->setName('peg_dokumen/view-peg_dokumen-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PegDokumenController::class . ':edit')->add(PermissionMiddleware::class)->setName('peg_dokumen/edit-peg_dokumen-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PegDokumenController::class . ':delete')->add(PermissionMiddleware::class)->setName('peg_dokumen/delete-peg_dokumen-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', PegDokumenController::class . ':preview')->add(PermissionMiddleware::class)->setName('peg_dokumen/preview-peg_dokumen-preview-2'); // preview
        }
    );

    // peg_keluarga
    $app->map(["GET","POST","OPTIONS"], '/PegKeluargaList[/{id}]', PegKeluargaController::class . ':list')->add(PermissionMiddleware::class)->setName('PegKeluargaList-peg_keluarga-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PegKeluargaAdd[/{id}]', PegKeluargaController::class . ':add')->add(PermissionMiddleware::class)->setName('PegKeluargaAdd-peg_keluarga-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PegKeluargaView[/{id}]', PegKeluargaController::class . ':view')->add(PermissionMiddleware::class)->setName('PegKeluargaView-peg_keluarga-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PegKeluargaEdit[/{id}]', PegKeluargaController::class . ':edit')->add(PermissionMiddleware::class)->setName('PegKeluargaEdit-peg_keluarga-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PegKeluargaDelete[/{id}]', PegKeluargaController::class . ':delete')->add(PermissionMiddleware::class)->setName('PegKeluargaDelete-peg_keluarga-delete'); // delete
    $app->map(["GET","OPTIONS"], '/PegKeluargaPreview', PegKeluargaController::class . ':preview')->add(PermissionMiddleware::class)->setName('PegKeluargaPreview-peg_keluarga-preview'); // preview
    $app->group(
        '/peg_keluarga',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PegKeluargaController::class . ':list')->add(PermissionMiddleware::class)->setName('peg_keluarga/list-peg_keluarga-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PegKeluargaController::class . ':add')->add(PermissionMiddleware::class)->setName('peg_keluarga/add-peg_keluarga-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PegKeluargaController::class . ':view')->add(PermissionMiddleware::class)->setName('peg_keluarga/view-peg_keluarga-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PegKeluargaController::class . ':edit')->add(PermissionMiddleware::class)->setName('peg_keluarga/edit-peg_keluarga-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PegKeluargaController::class . ':delete')->add(PermissionMiddleware::class)->setName('peg_keluarga/delete-peg_keluarga-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', PegKeluargaController::class . ':preview')->add(PermissionMiddleware::class)->setName('peg_keluarga/preview-peg_keluarga-preview-2'); // preview
        }
    );

    // peg_skill
    $app->map(["GET","POST","OPTIONS"], '/PegSkillList[/{id}]', PegSkillController::class . ':list')->add(PermissionMiddleware::class)->setName('PegSkillList-peg_skill-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PegSkillAdd[/{id}]', PegSkillController::class . ':add')->add(PermissionMiddleware::class)->setName('PegSkillAdd-peg_skill-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PegSkillView[/{id}]', PegSkillController::class . ':view')->add(PermissionMiddleware::class)->setName('PegSkillView-peg_skill-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PegSkillEdit[/{id}]', PegSkillController::class . ':edit')->add(PermissionMiddleware::class)->setName('PegSkillEdit-peg_skill-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PegSkillDelete[/{id}]', PegSkillController::class . ':delete')->add(PermissionMiddleware::class)->setName('PegSkillDelete-peg_skill-delete'); // delete
    $app->map(["GET","OPTIONS"], '/PegSkillPreview', PegSkillController::class . ':preview')->add(PermissionMiddleware::class)->setName('PegSkillPreview-peg_skill-preview'); // preview
    $app->group(
        '/peg_skill',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PegSkillController::class . ':list')->add(PermissionMiddleware::class)->setName('peg_skill/list-peg_skill-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PegSkillController::class . ':add')->add(PermissionMiddleware::class)->setName('peg_skill/add-peg_skill-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PegSkillController::class . ':view')->add(PermissionMiddleware::class)->setName('peg_skill/view-peg_skill-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PegSkillController::class . ':edit')->add(PermissionMiddleware::class)->setName('peg_skill/edit-peg_skill-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PegSkillController::class . ':delete')->add(PermissionMiddleware::class)->setName('peg_skill/delete-peg_skill-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', PegSkillController::class . ':preview')->add(PermissionMiddleware::class)->setName('peg_skill/preview-peg_skill-preview-2'); // preview
        }
    );

    // pegawai
    $app->map(["GET","POST","OPTIONS"], '/PegawaiList[/{id}]', PegawaiController::class . ':list')->add(PermissionMiddleware::class)->setName('PegawaiList-pegawai-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PegawaiAdd[/{id}]', PegawaiController::class . ':add')->add(PermissionMiddleware::class)->setName('PegawaiAdd-pegawai-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PegawaiView[/{id}]', PegawaiController::class . ':view')->add(PermissionMiddleware::class)->setName('PegawaiView-pegawai-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PegawaiEdit[/{id}]', PegawaiController::class . ':edit')->add(PermissionMiddleware::class)->setName('PegawaiEdit-pegawai-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PegawaiDelete[/{id}]', PegawaiController::class . ':delete')->add(PermissionMiddleware::class)->setName('PegawaiDelete-pegawai-delete'); // delete
    $app->group(
        '/pegawai',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PegawaiController::class . ':list')->add(PermissionMiddleware::class)->setName('pegawai/list-pegawai-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PegawaiController::class . ':add')->add(PermissionMiddleware::class)->setName('pegawai/add-pegawai-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PegawaiController::class . ':view')->add(PermissionMiddleware::class)->setName('pegawai/view-pegawai-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PegawaiController::class . ':edit')->add(PermissionMiddleware::class)->setName('pegawai/edit-pegawai-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PegawaiController::class . ':delete')->add(PermissionMiddleware::class)->setName('pegawai/delete-pegawai-delete-2'); // delete
        }
    );

    // penempatan
    $app->map(["GET","POST","OPTIONS"], '/PenempatanList[/{id}]', PenempatanController::class . ':list')->add(PermissionMiddleware::class)->setName('PenempatanList-penempatan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PenempatanAdd[/{id}]', PenempatanController::class . ':add')->add(PermissionMiddleware::class)->setName('PenempatanAdd-penempatan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PenempatanView[/{id}]', PenempatanController::class . ':view')->add(PermissionMiddleware::class)->setName('PenempatanView-penempatan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PenempatanEdit[/{id}]', PenempatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenempatanEdit-penempatan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PenempatanDelete[/{id}]', PenempatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('PenempatanDelete-penempatan-delete'); // delete
    $app->group(
        '/penempatan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PenempatanController::class . ':list')->add(PermissionMiddleware::class)->setName('penempatan/list-penempatan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PenempatanController::class . ':add')->add(PermissionMiddleware::class)->setName('penempatan/add-penempatan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PenempatanController::class . ':view')->add(PermissionMiddleware::class)->setName('penempatan/view-penempatan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PenempatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('penempatan/edit-penempatan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PenempatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('penempatan/delete-penempatan-delete-2'); // delete
        }
    );

    // pengetahuan
    $app->map(["GET","POST","OPTIONS"], '/PengetahuanList[/{id}]', PengetahuanController::class . ':list')->add(PermissionMiddleware::class)->setName('PengetahuanList-pengetahuan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PengetahuanAdd[/{id}]', PengetahuanController::class . ':add')->add(PermissionMiddleware::class)->setName('PengetahuanAdd-pengetahuan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PengetahuanView[/{id}]', PengetahuanController::class . ':view')->add(PermissionMiddleware::class)->setName('PengetahuanView-pengetahuan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PengetahuanEdit[/{id}]', PengetahuanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PengetahuanEdit-pengetahuan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PengetahuanDelete[/{id}]', PengetahuanController::class . ':delete')->add(PermissionMiddleware::class)->setName('PengetahuanDelete-pengetahuan-delete'); // delete
    $app->group(
        '/pengetahuan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PengetahuanController::class . ':list')->add(PermissionMiddleware::class)->setName('pengetahuan/list-pengetahuan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PengetahuanController::class . ':add')->add(PermissionMiddleware::class)->setName('pengetahuan/add-pengetahuan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PengetahuanController::class . ':view')->add(PermissionMiddleware::class)->setName('pengetahuan/view-pengetahuan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PengetahuanController::class . ':edit')->add(PermissionMiddleware::class)->setName('pengetahuan/edit-pengetahuan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PengetahuanController::class . ':delete')->add(PermissionMiddleware::class)->setName('pengetahuan/delete-pengetahuan-delete-2'); // delete
        }
    );

    // proyek
    $app->map(["GET","POST","OPTIONS"], '/ProyekList[/{id}]', ProyekController::class . ':list')->add(PermissionMiddleware::class)->setName('ProyekList-proyek-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProyekAdd[/{id}]', ProyekController::class . ':add')->add(PermissionMiddleware::class)->setName('ProyekAdd-proyek-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ProyekView[/{id}]', ProyekController::class . ':view')->add(PermissionMiddleware::class)->setName('ProyekView-proyek-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProyekEdit[/{id}]', ProyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProyekEdit-proyek-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProyekDelete[/{id}]', ProyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProyekDelete-proyek-delete'); // delete
    $app->group(
        '/proyek',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ProyekController::class . ':list')->add(PermissionMiddleware::class)->setName('proyek/list-proyek-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', ProyekController::class . ':add')->add(PermissionMiddleware::class)->setName('proyek/add-proyek-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ProyekController::class . ':view')->add(PermissionMiddleware::class)->setName('proyek/view-proyek-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', ProyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('proyek/edit-proyek-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', ProyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('proyek/delete-proyek-delete-2'); // delete
        }
    );

    // reimbursh
    $app->map(["GET","POST","OPTIONS"], '/ReimburshList[/{id}]', ReimburshController::class . ':list')->add(PermissionMiddleware::class)->setName('ReimburshList-reimbursh-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ReimburshAdd[/{id}]', ReimburshController::class . ':add')->add(PermissionMiddleware::class)->setName('ReimburshAdd-reimbursh-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ReimburshView[/{id}]', ReimburshController::class . ':view')->add(PermissionMiddleware::class)->setName('ReimburshView-reimbursh-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ReimburshEdit[/{id}]', ReimburshController::class . ':edit')->add(PermissionMiddleware::class)->setName('ReimburshEdit-reimbursh-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ReimburshDelete[/{id}]', ReimburshController::class . ':delete')->add(PermissionMiddleware::class)->setName('ReimburshDelete-reimbursh-delete'); // delete
    $app->group(
        '/reimbursh',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ReimburshController::class . ':list')->add(PermissionMiddleware::class)->setName('reimbursh/list-reimbursh-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', ReimburshController::class . ':add')->add(PermissionMiddleware::class)->setName('reimbursh/add-reimbursh-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ReimburshController::class . ':view')->add(PermissionMiddleware::class)->setName('reimbursh/view-reimbursh-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', ReimburshController::class . ':edit')->add(PermissionMiddleware::class)->setName('reimbursh/edit-reimbursh-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', ReimburshController::class . ':delete')->add(PermissionMiddleware::class)->setName('reimbursh/delete-reimbursh-delete-2'); // delete
        }
    );

    // uangmuka
    $app->map(["GET","POST","OPTIONS"], '/UangmukaList[/{id}]', UangmukaController::class . ':list')->add(PermissionMiddleware::class)->setName('UangmukaList-uangmuka-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UangmukaAdd[/{id}]', UangmukaController::class . ':add')->add(PermissionMiddleware::class)->setName('UangmukaAdd-uangmuka-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UangmukaView[/{id}]', UangmukaController::class . ':view')->add(PermissionMiddleware::class)->setName('UangmukaView-uangmuka-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UangmukaEdit[/{id}]', UangmukaController::class . ':edit')->add(PermissionMiddleware::class)->setName('UangmukaEdit-uangmuka-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UangmukaDelete[/{id}]', UangmukaController::class . ':delete')->add(PermissionMiddleware::class)->setName('UangmukaDelete-uangmuka-delete'); // delete
    $app->group(
        '/uangmuka',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', UangmukaController::class . ':list')->add(PermissionMiddleware::class)->setName('uangmuka/list-uangmuka-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', UangmukaController::class . ':add')->add(PermissionMiddleware::class)->setName('uangmuka/add-uangmuka-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', UangmukaController::class . ':view')->add(PermissionMiddleware::class)->setName('uangmuka/view-uangmuka-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', UangmukaController::class . ':edit')->add(PermissionMiddleware::class)->setName('uangmuka/edit-uangmuka-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', UangmukaController::class . ':delete')->add(PermissionMiddleware::class)->setName('uangmuka/delete-uangmuka-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsList[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsList-userlevelpermissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsAdd[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsAdd-userlevelpermissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsView[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsView-userlevelpermissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsEdit[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsEdit-userlevelpermissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsDelete[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsDelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsList[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsAdd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsView[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelsView-userlevels-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsEdit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsDelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // testtable
    $app->map(["GET","POST","OPTIONS"], '/TesttableList[/{id}]', TesttableController::class . ':list')->add(PermissionMiddleware::class)->setName('TesttableList-testtable-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TesttableAdd[/{id}]', TesttableController::class . ':add')->add(PermissionMiddleware::class)->setName('TesttableAdd-testtable-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TesttableView[/{id}]', TesttableController::class . ':view')->add(PermissionMiddleware::class)->setName('TesttableView-testtable-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TesttableEdit[/{id}]', TesttableController::class . ':edit')->add(PermissionMiddleware::class)->setName('TesttableEdit-testtable-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TesttableDelete[/{id}]', TesttableController::class . ':delete')->add(PermissionMiddleware::class)->setName('TesttableDelete-testtable-delete'); // delete
    $app->group(
        '/testtable',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', TesttableController::class . ':list')->add(PermissionMiddleware::class)->setName('testtable/list-testtable-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', TesttableController::class . ':add')->add(PermissionMiddleware::class)->setName('testtable/add-testtable-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', TesttableController::class . ':view')->add(PermissionMiddleware::class)->setName('testtable/view-testtable-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', TesttableController::class . ':edit')->add(PermissionMiddleware::class)->setName('testtable/edit-testtable-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', TesttableController::class . ':delete')->add(PermissionMiddleware::class)->setName('testtable/delete-testtable-delete-2'); // delete
        }
    );

    // potongan
    $app->map(["GET","POST","OPTIONS"], '/PotonganList[/{id}]', PotonganController::class . ':list')->add(PermissionMiddleware::class)->setName('PotonganList-potongan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PotonganAdd[/{id}]', PotonganController::class . ':add')->add(PermissionMiddleware::class)->setName('PotonganAdd-potongan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PotonganView[/{id}]', PotonganController::class . ':view')->add(PermissionMiddleware::class)->setName('PotonganView-potongan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PotonganEdit[/{id}]', PotonganController::class . ':edit')->add(PermissionMiddleware::class)->setName('PotonganEdit-potongan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PotonganDelete[/{id}]', PotonganController::class . ':delete')->add(PermissionMiddleware::class)->setName('PotonganDelete-potongan-delete'); // delete
    $app->group(
        '/potongan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PotonganController::class . ':list')->add(PermissionMiddleware::class)->setName('potongan/list-potongan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PotonganController::class . ':add')->add(PermissionMiddleware::class)->setName('potongan/add-potongan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PotonganController::class . ':view')->add(PermissionMiddleware::class)->setName('potongan/view-potongan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PotonganController::class . ':edit')->add(PermissionMiddleware::class)->setName('potongan/edit-potongan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PotonganController::class . ':delete')->add(PermissionMiddleware::class)->setName('potongan/delete-potongan-delete-2'); // delete
        }
    );

    // terlambat
    $app->map(["GET","POST","OPTIONS"], '/TerlambatList[/{id}]', TerlambatController::class . ':list')->add(PermissionMiddleware::class)->setName('TerlambatList-terlambat-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TerlambatAdd[/{id}]', TerlambatController::class . ':add')->add(PermissionMiddleware::class)->setName('TerlambatAdd-terlambat-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TerlambatView[/{id}]', TerlambatController::class . ':view')->add(PermissionMiddleware::class)->setName('TerlambatView-terlambat-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TerlambatEdit[/{id}]', TerlambatController::class . ':edit')->add(PermissionMiddleware::class)->setName('TerlambatEdit-terlambat-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TerlambatDelete[/{id}]', TerlambatController::class . ':delete')->add(PermissionMiddleware::class)->setName('TerlambatDelete-terlambat-delete'); // delete
    $app->group(
        '/terlambat',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', TerlambatController::class . ':list')->add(PermissionMiddleware::class)->setName('terlambat/list-terlambat-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', TerlambatController::class . ':add')->add(PermissionMiddleware::class)->setName('terlambat/add-terlambat-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', TerlambatController::class . ':view')->add(PermissionMiddleware::class)->setName('terlambat/view-terlambat-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', TerlambatController::class . ':edit')->add(PermissionMiddleware::class)->setName('terlambat/edit-terlambat-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', TerlambatController::class . ':delete')->add(PermissionMiddleware::class)->setName('terlambat/delete-terlambat-delete-2'); // delete
        }
    );

    // totalgaji
    $app->map(["GET","POST","OPTIONS"], '/TotalgajiList', TotalgajiController::class . ':list')->add(PermissionMiddleware::class)->setName('TotalgajiList-totalgaji-list'); // list
    $app->group(
        '/totalgaji',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', TotalgajiController::class . ':list')->add(PermissionMiddleware::class)->setName('totalgaji/list-totalgaji-list-2'); // list
        }
    );

    // agama
    $app->map(["GET","POST","OPTIONS"], '/AgamaList[/{id}]', AgamaController::class . ':list')->add(PermissionMiddleware::class)->setName('AgamaList-agama-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AgamaAdd[/{id}]', AgamaController::class . ':add')->add(PermissionMiddleware::class)->setName('AgamaAdd-agama-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/AgamaView[/{id}]', AgamaController::class . ':view')->add(PermissionMiddleware::class)->setName('AgamaView-agama-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AgamaEdit[/{id}]', AgamaController::class . ':edit')->add(PermissionMiddleware::class)->setName('AgamaEdit-agama-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AgamaDelete[/{id}]', AgamaController::class . ':delete')->add(PermissionMiddleware::class)->setName('AgamaDelete-agama-delete'); // delete
    $app->group(
        '/agama',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AgamaController::class . ':list')->add(PermissionMiddleware::class)->setName('agama/list-agama-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AgamaController::class . ':add')->add(PermissionMiddleware::class)->setName('agama/add-agama-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AgamaController::class . ':view')->add(PermissionMiddleware::class)->setName('agama/view-agama-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AgamaController::class . ':edit')->add(PermissionMiddleware::class)->setName('agama/edit-agama-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AgamaController::class . ':delete')->add(PermissionMiddleware::class)->setName('agama/delete-agama-delete-2'); // delete
        }
    );

    // tpendidikan
    $app->map(["GET","POST","OPTIONS"], '/TpendidikanList[/{id}]', TpendidikanController::class . ':list')->add(PermissionMiddleware::class)->setName('TpendidikanList-tpendidikan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TpendidikanAdd[/{id}]', TpendidikanController::class . ':add')->add(PermissionMiddleware::class)->setName('TpendidikanAdd-tpendidikan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/TpendidikanView[/{id}]', TpendidikanController::class . ':view')->add(PermissionMiddleware::class)->setName('TpendidikanView-tpendidikan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TpendidikanEdit[/{id}]', TpendidikanController::class . ':edit')->add(PermissionMiddleware::class)->setName('TpendidikanEdit-tpendidikan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TpendidikanDelete[/{id}]', TpendidikanController::class . ':delete')->add(PermissionMiddleware::class)->setName('TpendidikanDelete-tpendidikan-delete'); // delete
    $app->group(
        '/tpendidikan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', TpendidikanController::class . ':list')->add(PermissionMiddleware::class)->setName('tpendidikan/list-tpendidikan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', TpendidikanController::class . ':add')->add(PermissionMiddleware::class)->setName('tpendidikan/add-tpendidikan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', TpendidikanController::class . ':view')->add(PermissionMiddleware::class)->setName('tpendidikan/view-tpendidikan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', TpendidikanController::class . ':edit')->add(PermissionMiddleware::class)->setName('tpendidikan/edit-tpendidikan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', TpendidikanController::class . ':delete')->add(PermissionMiddleware::class)->setName('tpendidikan/delete-tpendidikan-delete-2'); // delete
        }
    );

    // m_tidakhadir
    $app->map(["GET","POST","OPTIONS"], '/MTidakhadirList[/{id}]', MTidakhadirController::class . ':list')->add(PermissionMiddleware::class)->setName('MTidakhadirList-m_tidakhadir-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/MTidakhadirAdd[/{id}]', MTidakhadirController::class . ':add')->add(PermissionMiddleware::class)->setName('MTidakhadirAdd-m_tidakhadir-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/MTidakhadirEdit[/{id}]', MTidakhadirController::class . ':edit')->add(PermissionMiddleware::class)->setName('MTidakhadirEdit-m_tidakhadir-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/MTidakhadirDelete[/{id}]', MTidakhadirController::class . ':delete')->add(PermissionMiddleware::class)->setName('MTidakhadirDelete-m_tidakhadir-delete'); // delete
    $app->group(
        '/m_tidakhadir',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MTidakhadirController::class . ':list')->add(PermissionMiddleware::class)->setName('m_tidakhadir/list-m_tidakhadir-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MTidakhadirController::class . ':add')->add(PermissionMiddleware::class)->setName('m_tidakhadir/add-m_tidakhadir-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MTidakhadirController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_tidakhadir/edit-m_tidakhadir-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MTidakhadirController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_tidakhadir/delete-m_tidakhadir-delete-2'); // delete
        }
    );

    // gaji
    $app->map(["GET","POST","OPTIONS"], '/GajiList[/{id}]', GajiController::class . ':list')->add(PermissionMiddleware::class)->setName('GajiList-gaji-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajiAdd[/{id}]', GajiController::class . ':add')->add(PermissionMiddleware::class)->setName('GajiAdd-gaji-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajiView[/{id}]', GajiController::class . ':view')->add(PermissionMiddleware::class)->setName('GajiView-gaji-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajiEdit[/{id}]', GajiController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajiEdit-gaji-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajiDelete[/{id}]', GajiController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajiDelete-gaji-delete'); // delete
    $app->group(
        '/gaji',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajiController::class . ':list')->add(PermissionMiddleware::class)->setName('gaji/list-gaji-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajiController::class . ':add')->add(PermissionMiddleware::class)->setName('gaji/add-gaji-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajiController::class . ':view')->add(PermissionMiddleware::class)->setName('gaji/view-gaji-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajiController::class . ':edit')->add(PermissionMiddleware::class)->setName('gaji/edit-gaji-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajiController::class . ':delete')->add(PermissionMiddleware::class)->setName('gaji/delete-gaji-delete-2'); // delete
        }
    );

    // gender
    $app->map(["GET","POST","OPTIONS"], '/GenderList[/{id}]', GenderController::class . ':list')->add(PermissionMiddleware::class)->setName('GenderList-gender-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GenderAdd[/{id}]', GenderController::class . ':add')->add(PermissionMiddleware::class)->setName('GenderAdd-gender-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GenderView[/{id}]', GenderController::class . ':view')->add(PermissionMiddleware::class)->setName('GenderView-gender-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GenderEdit[/{id}]', GenderController::class . ':edit')->add(PermissionMiddleware::class)->setName('GenderEdit-gender-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GenderDelete[/{id}]', GenderController::class . ':delete')->add(PermissionMiddleware::class)->setName('GenderDelete-gender-delete'); // delete
    $app->group(
        '/gender',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GenderController::class . ':list')->add(PermissionMiddleware::class)->setName('gender/list-gender-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GenderController::class . ':add')->add(PermissionMiddleware::class)->setName('gender/add-gender-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GenderController::class . ':view')->add(PermissionMiddleware::class)->setName('gender/view-gender-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GenderController::class . ':edit')->add(PermissionMiddleware::class)->setName('gender/edit-gender-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GenderController::class . ':delete')->add(PermissionMiddleware::class)->setName('gender/delete-gender-delete-2'); // delete
        }
    );

    // bulan
    $app->map(["GET","POST","OPTIONS"], '/BulanList[/{id}]', BulanController::class . ':list')->add(PermissionMiddleware::class)->setName('BulanList-bulan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/BulanAdd[/{id}]', BulanController::class . ':add')->add(PermissionMiddleware::class)->setName('BulanAdd-bulan-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/BulanEdit[/{id}]', BulanController::class . ':edit')->add(PermissionMiddleware::class)->setName('BulanEdit-bulan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/BulanDelete[/{id}]', BulanController::class . ':delete')->add(PermissionMiddleware::class)->setName('BulanDelete-bulan-delete'); // delete
    $app->group(
        '/bulan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', BulanController::class . ':list')->add(PermissionMiddleware::class)->setName('bulan/list-bulan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', BulanController::class . ':add')->add(PermissionMiddleware::class)->setName('bulan/add-bulan-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', BulanController::class . ':edit')->add(PermissionMiddleware::class)->setName('bulan/edit-bulan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', BulanController::class . ':delete')->add(PermissionMiddleware::class)->setName('bulan/delete-bulan-delete-2'); // delete
        }
    );

    // gajisd
    $app->map(["GET","POST","OPTIONS"], '/GajisdList[/{id}]', GajisdController::class . ':list')->add(PermissionMiddleware::class)->setName('GajisdList-gajisd-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajisdAdd[/{id}]', GajisdController::class . ':add')->add(PermissionMiddleware::class)->setName('GajisdAdd-gajisd-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajisdView[/{id}]', GajisdController::class . ':view')->add(PermissionMiddleware::class)->setName('GajisdView-gajisd-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajisdEdit[/{id}]', GajisdController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajisdEdit-gajisd-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajisdDelete[/{id}]', GajisdController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajisdDelete-gajisd-delete'); // delete
    $app->group(
        '/gajisd',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajisdController::class . ':list')->add(PermissionMiddleware::class)->setName('gajisd/list-gajisd-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajisdController::class . ':add')->add(PermissionMiddleware::class)->setName('gajisd/add-gajisd-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajisdController::class . ':view')->add(PermissionMiddleware::class)->setName('gajisd/view-gajisd-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajisdController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajisd/edit-gajisd-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajisdController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajisd/delete-gajisd-delete-2'); // delete
        }
    );

    // gajisd_detil
    $app->map(["GET","POST","OPTIONS"], '/GajisdDetilList[/{id}]', GajisdDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('GajisdDetilList-gajisd_detil-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajisdDetilAdd[/{id}]', GajisdDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('GajisdDetilAdd-gajisd_detil-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajisdDetilView[/{id}]', GajisdDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('GajisdDetilView-gajisd_detil-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajisdDetilEdit[/{id}]', GajisdDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajisdDetilEdit-gajisd_detil-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajisdDetilDelete[/{id}]', GajisdDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajisdDetilDelete-gajisd_detil-delete'); // delete
    $app->map(["GET","OPTIONS"], '/GajisdDetilPreview', GajisdDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('GajisdDetilPreview-gajisd_detil-preview'); // preview
    $app->group(
        '/gajisd_detil',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajisdDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('gajisd_detil/list-gajisd_detil-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajisdDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('gajisd_detil/add-gajisd_detil-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajisdDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('gajisd_detil/view-gajisd_detil-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajisdDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajisd_detil/edit-gajisd_detil-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajisdDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajisd_detil/delete-gajisd_detil-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', GajisdDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('gajisd_detil/preview-gajisd_detil-preview-2'); // preview
        }
    );

    // gajitk
    $app->map(["GET","POST","OPTIONS"], '/GajitkList[/{id}]', GajitkController::class . ':list')->add(PermissionMiddleware::class)->setName('GajitkList-gajitk-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajitkAdd[/{id}]', GajitkController::class . ':add')->add(PermissionMiddleware::class)->setName('GajitkAdd-gajitk-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajitkView[/{id}]', GajitkController::class . ':view')->add(PermissionMiddleware::class)->setName('GajitkView-gajitk-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajitkEdit[/{id}]', GajitkController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajitkEdit-gajitk-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajitkDelete[/{id}]', GajitkController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajitkDelete-gajitk-delete'); // delete
    $app->group(
        '/gajitk',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajitkController::class . ':list')->add(PermissionMiddleware::class)->setName('gajitk/list-gajitk-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajitkController::class . ':add')->add(PermissionMiddleware::class)->setName('gajitk/add-gajitk-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajitkController::class . ':view')->add(PermissionMiddleware::class)->setName('gajitk/view-gajitk-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajitkController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajitk/edit-gajitk-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajitkController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajitk/delete-gajitk-delete-2'); // delete
        }
    );

    // gajitk_detil
    $app->map(["GET","POST","OPTIONS"], '/GajitkDetilList[/{id}]', GajitkDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('GajitkDetilList-gajitk_detil-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajitkDetilAdd[/{id}]', GajitkDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('GajitkDetilAdd-gajitk_detil-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajitkDetilView[/{id}]', GajitkDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('GajitkDetilView-gajitk_detil-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajitkDetilEdit[/{id}]', GajitkDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajitkDetilEdit-gajitk_detil-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajitkDetilDelete[/{id}]', GajitkDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajitkDetilDelete-gajitk_detil-delete'); // delete
    $app->map(["GET","OPTIONS"], '/GajitkDetilPreview', GajitkDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('GajitkDetilPreview-gajitk_detil-preview'); // preview
    $app->group(
        '/gajitk_detil',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajitkDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('gajitk_detil/list-gajitk_detil-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajitkDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('gajitk_detil/add-gajitk_detil-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajitkDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('gajitk_detil/view-gajitk_detil-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajitkDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajitk_detil/edit-gajitk_detil-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajitkDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajitk_detil/delete-gajitk_detil-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', GajitkDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('gajitk_detil/preview-gajitk_detil-preview-2'); // preview
        }
    );

    // gajisma
    $app->map(["GET","POST","OPTIONS"], '/GajismaList[/{id}]', GajismaController::class . ':list')->add(PermissionMiddleware::class)->setName('GajismaList-gajisma-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajismaAdd[/{id}]', GajismaController::class . ':add')->add(PermissionMiddleware::class)->setName('GajismaAdd-gajisma-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajismaView[/{id}]', GajismaController::class . ':view')->add(PermissionMiddleware::class)->setName('GajismaView-gajisma-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajismaEdit[/{id}]', GajismaController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajismaEdit-gajisma-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajismaDelete[/{id}]', GajismaController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajismaDelete-gajisma-delete'); // delete
    $app->group(
        '/gajisma',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajismaController::class . ':list')->add(PermissionMiddleware::class)->setName('gajisma/list-gajisma-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajismaController::class . ':add')->add(PermissionMiddleware::class)->setName('gajisma/add-gajisma-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajismaController::class . ':view')->add(PermissionMiddleware::class)->setName('gajisma/view-gajisma-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajismaController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajisma/edit-gajisma-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajismaController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajisma/delete-gajisma-delete-2'); // delete
        }
    );

    // gajisma_detil
    $app->map(["GET","POST","OPTIONS"], '/GajismaDetilList[/{id}]', GajismaDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('GajismaDetilList-gajisma_detil-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajismaDetilAdd[/{id}]', GajismaDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('GajismaDetilAdd-gajisma_detil-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajismaDetilView[/{id}]', GajismaDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('GajismaDetilView-gajisma_detil-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajismaDetilEdit[/{id}]', GajismaDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajismaDetilEdit-gajisma_detil-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajismaDetilDelete[/{id}]', GajismaDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajismaDetilDelete-gajisma_detil-delete'); // delete
    $app->map(["GET","OPTIONS"], '/GajismaDetilPreview', GajismaDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('GajismaDetilPreview-gajisma_detil-preview'); // preview
    $app->group(
        '/gajisma_detil',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajismaDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('gajisma_detil/list-gajisma_detil-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajismaDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('gajisma_detil/add-gajisma_detil-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajismaDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('gajisma_detil/view-gajisma_detil-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajismaDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajisma_detil/edit-gajisma_detil-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajismaDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajisma_detil/delete-gajisma_detil-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', GajismaDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('gajisma_detil/preview-gajisma_detil-preview-2'); // preview
        }
    );

    // gajismk
    $app->map(["GET","POST","OPTIONS"], '/GajismkList[/{id}]', GajismkController::class . ':list')->add(PermissionMiddleware::class)->setName('GajismkList-gajismk-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajismkAdd[/{id}]', GajismkController::class . ':add')->add(PermissionMiddleware::class)->setName('GajismkAdd-gajismk-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajismkView[/{id}]', GajismkController::class . ':view')->add(PermissionMiddleware::class)->setName('GajismkView-gajismk-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajismkEdit[/{id}]', GajismkController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajismkEdit-gajismk-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajismkDelete[/{id}]', GajismkController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajismkDelete-gajismk-delete'); // delete
    $app->group(
        '/gajismk',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajismkController::class . ':list')->add(PermissionMiddleware::class)->setName('gajismk/list-gajismk-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajismkController::class . ':add')->add(PermissionMiddleware::class)->setName('gajismk/add-gajismk-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajismkController::class . ':view')->add(PermissionMiddleware::class)->setName('gajismk/view-gajismk-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajismkController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajismk/edit-gajismk-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajismkController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajismk/delete-gajismk-delete-2'); // delete
        }
    );

    // gajismk_detil
    $app->map(["GET","POST","OPTIONS"], '/GajismkDetilList[/{id}]', GajismkDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('GajismkDetilList-gajismk_detil-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajismkDetilAdd[/{id}]', GajismkDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('GajismkDetilAdd-gajismk_detil-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajismkDetilView[/{id}]', GajismkDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('GajismkDetilView-gajismk_detil-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajismkDetilEdit[/{id}]', GajismkDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajismkDetilEdit-gajismk_detil-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajismkDetilDelete[/{id}]', GajismkDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajismkDetilDelete-gajismk_detil-delete'); // delete
    $app->map(["GET","OPTIONS"], '/GajismkDetilPreview', GajismkDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('GajismkDetilPreview-gajismk_detil-preview'); // preview
    $app->group(
        '/gajismk_detil',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajismkDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('gajismk_detil/list-gajismk_detil-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajismkDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('gajismk_detil/add-gajismk_detil-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajismkDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('gajismk_detil/view-gajismk_detil-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajismkDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajismk_detil/edit-gajismk_detil-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajismkDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajismk_detil/delete-gajismk_detil-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', GajismkDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('gajismk_detil/preview-gajismk_detil-preview-2'); // preview
        }
    );

    // gajismp
    $app->map(["GET","POST","OPTIONS"], '/GajismpList[/{id}]', GajismpController::class . ':list')->add(PermissionMiddleware::class)->setName('GajismpList-gajismp-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajismpAdd[/{id}]', GajismpController::class . ':add')->add(PermissionMiddleware::class)->setName('GajismpAdd-gajismp-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajismpView[/{id}]', GajismpController::class . ':view')->add(PermissionMiddleware::class)->setName('GajismpView-gajismp-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajismpEdit[/{id}]', GajismpController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajismpEdit-gajismp-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajismpDelete[/{id}]', GajismpController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajismpDelete-gajismp-delete'); // delete
    $app->group(
        '/gajismp',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajismpController::class . ':list')->add(PermissionMiddleware::class)->setName('gajismp/list-gajismp-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajismpController::class . ':add')->add(PermissionMiddleware::class)->setName('gajismp/add-gajismp-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajismpController::class . ':view')->add(PermissionMiddleware::class)->setName('gajismp/view-gajismp-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajismpController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajismp/edit-gajismp-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajismpController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajismp/delete-gajismp-delete-2'); // delete
        }
    );

    // gajismp_detil
    $app->map(["GET","POST","OPTIONS"], '/GajismpDetilList[/{id}]', GajismpDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('GajismpDetilList-gajismp_detil-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajismpDetilAdd[/{id}]', GajismpDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('GajismpDetilAdd-gajismp_detil-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajismpDetilView[/{id}]', GajismpDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('GajismpDetilView-gajismp_detil-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajismpDetilEdit[/{id}]', GajismpDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajismpDetilEdit-gajismp_detil-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajismpDetilDelete[/{id}]', GajismpDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajismpDetilDelete-gajismp_detil-delete'); // delete
    $app->map(["GET","OPTIONS"], '/GajismpDetilPreview', GajismpDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('GajismpDetilPreview-gajismp_detil-preview'); // preview
    $app->group(
        '/gajismp_detil',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajismpDetilController::class . ':list')->add(PermissionMiddleware::class)->setName('gajismp_detil/list-gajismp_detil-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajismpDetilController::class . ':add')->add(PermissionMiddleware::class)->setName('gajismp_detil/add-gajismp_detil-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajismpDetilController::class . ':view')->add(PermissionMiddleware::class)->setName('gajismp_detil/view-gajismp_detil-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajismpDetilController::class . ':edit')->add(PermissionMiddleware::class)->setName('gajismp_detil/edit-gajismp_detil-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajismpDetilController::class . ':delete')->add(PermissionMiddleware::class)->setName('gajismp_detil/delete-gajismp_detil-delete-2'); // delete
            $group->map(["GET","OPTIONS"], '/' . Config("PREVIEW_ACTION") . '', GajismpDetilController::class . ':preview')->add(PermissionMiddleware::class)->setName('gajismp_detil/preview-gajismp_detil-preview-2'); // preview
        }
    );

    // m_pulangcepat
    $app->map(["GET","POST","OPTIONS"], '/MPulangcepatList[/{id}]', MPulangcepatController::class . ':list')->add(PermissionMiddleware::class)->setName('MPulangcepatList-m_pulangcepat-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/MPulangcepatAdd[/{id}]', MPulangcepatController::class . ':add')->add(PermissionMiddleware::class)->setName('MPulangcepatAdd-m_pulangcepat-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/MPulangcepatView[/{id}]', MPulangcepatController::class . ':view')->add(PermissionMiddleware::class)->setName('MPulangcepatView-m_pulangcepat-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/MPulangcepatEdit[/{id}]', MPulangcepatController::class . ':edit')->add(PermissionMiddleware::class)->setName('MPulangcepatEdit-m_pulangcepat-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/MPulangcepatDelete[/{id}]', MPulangcepatController::class . ':delete')->add(PermissionMiddleware::class)->setName('MPulangcepatDelete-m_pulangcepat-delete'); // delete
    $app->group(
        '/m_pulangcepat',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MPulangcepatController::class . ':list')->add(PermissionMiddleware::class)->setName('m_pulangcepat/list-m_pulangcepat-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MPulangcepatController::class . ':add')->add(PermissionMiddleware::class)->setName('m_pulangcepat/add-m_pulangcepat-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MPulangcepatController::class . ':view')->add(PermissionMiddleware::class)->setName('m_pulangcepat/view-m_pulangcepat-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MPulangcepatController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_pulangcepat/edit-m_pulangcepat-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MPulangcepatController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_pulangcepat/delete-m_pulangcepat-delete-2'); // delete
        }
    );

    // m_sakit
    $app->map(["GET","POST","OPTIONS"], '/MSakitList[/{id}]', MSakitController::class . ':list')->add(PermissionMiddleware::class)->setName('MSakitList-m_sakit-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/MSakitAdd[/{id}]', MSakitController::class . ':add')->add(PermissionMiddleware::class)->setName('MSakitAdd-m_sakit-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/MSakitView[/{id}]', MSakitController::class . ':view')->add(PermissionMiddleware::class)->setName('MSakitView-m_sakit-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/MSakitEdit[/{id}]', MSakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('MSakitEdit-m_sakit-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/MSakitDelete[/{id}]', MSakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('MSakitDelete-m_sakit-delete'); // delete
    $app->group(
        '/m_sakit',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MSakitController::class . ':list')->add(PermissionMiddleware::class)->setName('m_sakit/list-m_sakit-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MSakitController::class . ':add')->add(PermissionMiddleware::class)->setName('m_sakit/add-m_sakit-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MSakitController::class . ':view')->add(PermissionMiddleware::class)->setName('m_sakit/view-m_sakit-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MSakitController::class . ':edit')->add(PermissionMiddleware::class)->setName('m_sakit/edit-m_sakit-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MSakitController::class . ':delete')->add(PermissionMiddleware::class)->setName('m_sakit/delete-m_sakit-delete-2'); // delete
        }
    );

    // gaji_pokok
    $app->map(["GET","POST","OPTIONS"], '/GajiPokokList[/{id}]', GajiPokokController::class . ':list')->add(PermissionMiddleware::class)->setName('GajiPokokList-gaji_pokok-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/GajiPokokAdd[/{id}]', GajiPokokController::class . ':add')->add(PermissionMiddleware::class)->setName('GajiPokokAdd-gaji_pokok-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/GajiPokokView[/{id}]', GajiPokokController::class . ':view')->add(PermissionMiddleware::class)->setName('GajiPokokView-gaji_pokok-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/GajiPokokEdit[/{id}]', GajiPokokController::class . ':edit')->add(PermissionMiddleware::class)->setName('GajiPokokEdit-gaji_pokok-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/GajiPokokDelete[/{id}]', GajiPokokController::class . ':delete')->add(PermissionMiddleware::class)->setName('GajiPokokDelete-gaji_pokok-delete'); // delete
    $app->group(
        '/gaji_pokok',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', GajiPokokController::class . ':list')->add(PermissionMiddleware::class)->setName('gaji_pokok/list-gaji_pokok-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', GajiPokokController::class . ':add')->add(PermissionMiddleware::class)->setName('gaji_pokok/add-gaji_pokok-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', GajiPokokController::class . ':view')->add(PermissionMiddleware::class)->setName('gaji_pokok/view-gaji_pokok-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', GajiPokokController::class . ':edit')->add(PermissionMiddleware::class)->setName('gaji_pokok/edit-gaji_pokok-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', GajiPokokController::class . ':delete')->add(PermissionMiddleware::class)->setName('gaji_pokok/delete-gaji_pokok-delete-2'); // delete
        }
    );

    // ijazah
    $app->map(["GET","POST","OPTIONS"], '/IjazahList[/{id}]', IjazahController::class . ':list')->add(PermissionMiddleware::class)->setName('IjazahList-ijazah-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/IjazahAdd[/{id}]', IjazahController::class . ':add')->add(PermissionMiddleware::class)->setName('IjazahAdd-ijazah-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/IjazahView[/{id}]', IjazahController::class . ':view')->add(PermissionMiddleware::class)->setName('IjazahView-ijazah-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/IjazahEdit[/{id}]', IjazahController::class . ':edit')->add(PermissionMiddleware::class)->setName('IjazahEdit-ijazah-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/IjazahDelete[/{id}]', IjazahController::class . ':delete')->add(PermissionMiddleware::class)->setName('IjazahDelete-ijazah-delete'); // delete
    $app->group(
        '/ijazah',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', IjazahController::class . ':list')->add(PermissionMiddleware::class)->setName('ijazah/list-ijazah-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', IjazahController::class . ':add')->add(PermissionMiddleware::class)->setName('ijazah/add-ijazah-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', IjazahController::class . ':view')->add(PermissionMiddleware::class)->setName('ijazah/view-ijazah-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', IjazahController::class . ':edit')->add(PermissionMiddleware::class)->setName('ijazah/edit-ijazah-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', IjazahController::class . ':delete')->add(PermissionMiddleware::class)->setName('ijazah/delete-ijazah-delete-2'); // delete
        }
    );

    // potongan_sd
    $app->map(["GET","POST","OPTIONS"], '/PotonganSdList[/{id}]', PotonganSdController::class . ':list')->add(PermissionMiddleware::class)->setName('PotonganSdList-potongan_sd-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PotonganSdAdd[/{id}]', PotonganSdController::class . ':add')->add(PermissionMiddleware::class)->setName('PotonganSdAdd-potongan_sd-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PotonganSdView[/{id}]', PotonganSdController::class . ':view')->add(PermissionMiddleware::class)->setName('PotonganSdView-potongan_sd-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PotonganSdEdit[/{id}]', PotonganSdController::class . ':edit')->add(PermissionMiddleware::class)->setName('PotonganSdEdit-potongan_sd-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PotonganSdDelete[/{id}]', PotonganSdController::class . ':delete')->add(PermissionMiddleware::class)->setName('PotonganSdDelete-potongan_sd-delete'); // delete
    $app->group(
        '/potongan_sd',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PotonganSdController::class . ':list')->add(PermissionMiddleware::class)->setName('potongan_sd/list-potongan_sd-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PotonganSdController::class . ':add')->add(PermissionMiddleware::class)->setName('potongan_sd/add-potongan_sd-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PotonganSdController::class . ':view')->add(PermissionMiddleware::class)->setName('potongan_sd/view-potongan_sd-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PotonganSdController::class . ':edit')->add(PermissionMiddleware::class)->setName('potongan_sd/edit-potongan_sd-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PotonganSdController::class . ':delete')->add(PermissionMiddleware::class)->setName('potongan_sd/delete-potongan_sd-delete-2'); // delete
        }
    );

    // potongan_smp
    $app->map(["GET","POST","OPTIONS"], '/PotonganSmpList[/{id}]', PotonganSmpController::class . ':list')->add(PermissionMiddleware::class)->setName('PotonganSmpList-potongan_smp-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PotonganSmpAdd[/{id}]', PotonganSmpController::class . ':add')->add(PermissionMiddleware::class)->setName('PotonganSmpAdd-potongan_smp-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/PotonganSmpView[/{id}]', PotonganSmpController::class . ':view')->add(PermissionMiddleware::class)->setName('PotonganSmpView-potongan_smp-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PotonganSmpEdit[/{id}]', PotonganSmpController::class . ':edit')->add(PermissionMiddleware::class)->setName('PotonganSmpEdit-potongan_smp-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PotonganSmpDelete[/{id}]', PotonganSmpController::class . ':delete')->add(PermissionMiddleware::class)->setName('PotonganSmpDelete-potongan_smp-delete'); // delete
    $app->group(
        '/potongan_smp',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PotonganSmpController::class . ':list')->add(PermissionMiddleware::class)->setName('potongan_smp/list-potongan_smp-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PotonganSmpController::class . ':add')->add(PermissionMiddleware::class)->setName('potongan_smp/add-potongan_smp-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PotonganSmpController::class . ':view')->add(PermissionMiddleware::class)->setName('potongan_smp/view-potongan_smp-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PotonganSmpController::class . ':edit')->add(PermissionMiddleware::class)->setName('potongan_smp/edit-potongan_smp-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PotonganSmpController::class . ':delete')->add(PermissionMiddleware::class)->setName('potongan_smp/delete-potongan_smp-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
