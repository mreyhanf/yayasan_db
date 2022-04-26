<?php

namespace PHPMaker2022\project1;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // ajuanproposal
    $app->map(["GET","POST","OPTIONS"], '/AjuanproposalList[/{keys:.*}]', AjuanproposalController::class . ':list')->add(PermissionMiddleware::class)->setName('AjuanproposalList-ajuanproposal-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AjuanproposalAdd[/{keys:.*}]', AjuanproposalController::class . ':add')->add(PermissionMiddleware::class)->setName('AjuanproposalAdd-ajuanproposal-add'); // add
    $app->map(["GET","OPTIONS"], '/AjuanproposalView[/{keys:.*}]', AjuanproposalController::class . ':view')->add(PermissionMiddleware::class)->setName('AjuanproposalView-ajuanproposal-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AjuanproposalEdit[/{keys:.*}]', AjuanproposalController::class . ':edit')->add(PermissionMiddleware::class)->setName('AjuanproposalEdit-ajuanproposal-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AjuanproposalDelete[/{keys:.*}]', AjuanproposalController::class . ':delete')->add(PermissionMiddleware::class)->setName('AjuanproposalDelete-ajuanproposal-delete'); // delete
    $app->group(
        '/ajuanproposal',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', AjuanproposalController::class . ':list')->add(PermissionMiddleware::class)->setName('ajuanproposal/list-ajuanproposal-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', AjuanproposalController::class . ':add')->add(PermissionMiddleware::class)->setName('ajuanproposal/add-ajuanproposal-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', AjuanproposalController::class . ':view')->add(PermissionMiddleware::class)->setName('ajuanproposal/view-ajuanproposal-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', AjuanproposalController::class . ':edit')->add(PermissionMiddleware::class)->setName('ajuanproposal/edit-ajuanproposal-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', AjuanproposalController::class . ':delete')->add(PermissionMiddleware::class)->setName('ajuanproposal/delete-ajuanproposal-delete-2'); // delete
        }
    );

    // ajuanproyek
    $app->map(["GET","POST","OPTIONS"], '/AjuanproyekList[/{idAjuanProyek}]', AjuanproyekController::class . ':list')->add(PermissionMiddleware::class)->setName('AjuanproyekList-ajuanproyek-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AjuanproyekAdd[/{idAjuanProyek}]', AjuanproyekController::class . ':add')->add(PermissionMiddleware::class)->setName('AjuanproyekAdd-ajuanproyek-add'); // add
    $app->map(["GET","OPTIONS"], '/AjuanproyekView[/{idAjuanProyek}]', AjuanproyekController::class . ':view')->add(PermissionMiddleware::class)->setName('AjuanproyekView-ajuanproyek-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AjuanproyekEdit[/{idAjuanProyek}]', AjuanproyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('AjuanproyekEdit-ajuanproyek-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AjuanproyekDelete[/{idAjuanProyek}]', AjuanproyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('AjuanproyekDelete-ajuanproyek-delete'); // delete
    $app->group(
        '/ajuanproyek',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idAjuanProyek}]', AjuanproyekController::class . ':list')->add(PermissionMiddleware::class)->setName('ajuanproyek/list-ajuanproyek-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idAjuanProyek}]', AjuanproyekController::class . ':add')->add(PermissionMiddleware::class)->setName('ajuanproyek/add-ajuanproyek-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idAjuanProyek}]', AjuanproyekController::class . ':view')->add(PermissionMiddleware::class)->setName('ajuanproyek/view-ajuanproyek-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idAjuanProyek}]', AjuanproyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('ajuanproyek/edit-ajuanproyek-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idAjuanProyek}]', AjuanproyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('ajuanproyek/delete-ajuanproyek-delete-2'); // delete
        }
    );

    // anggota
    $app->map(["GET","POST","OPTIONS"], '/AnggotaList[/{idAnggota}]', AnggotaController::class . ':list')->add(PermissionMiddleware::class)->setName('AnggotaList-anggota-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/AnggotaAdd[/{idAnggota}]', AnggotaController::class . ':add')->add(PermissionMiddleware::class)->setName('AnggotaAdd-anggota-add'); // add
    $app->map(["GET","OPTIONS"], '/AnggotaView[/{idAnggota}]', AnggotaController::class . ':view')->add(PermissionMiddleware::class)->setName('AnggotaView-anggota-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/AnggotaEdit[/{idAnggota}]', AnggotaController::class . ':edit')->add(PermissionMiddleware::class)->setName('AnggotaEdit-anggota-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/AnggotaDelete[/{idAnggota}]', AnggotaController::class . ':delete')->add(PermissionMiddleware::class)->setName('AnggotaDelete-anggota-delete'); // delete
    $app->group(
        '/anggota',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idAnggota}]', AnggotaController::class . ':list')->add(PermissionMiddleware::class)->setName('anggota/list-anggota-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idAnggota}]', AnggotaController::class . ':add')->add(PermissionMiddleware::class)->setName('anggota/add-anggota-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idAnggota}]', AnggotaController::class . ':view')->add(PermissionMiddleware::class)->setName('anggota/view-anggota-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idAnggota}]', AnggotaController::class . ':edit')->add(PermissionMiddleware::class)->setName('anggota/edit-anggota-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idAnggota}]', AnggotaController::class . ':delete')->add(PermissionMiddleware::class)->setName('anggota/delete-anggota-delete-2'); // delete
        }
    );

    // donasi
    $app->map(["GET","POST","OPTIONS"], '/DonasiList[/{idDonasi}]', DonasiController::class . ':list')->add(PermissionMiddleware::class)->setName('DonasiList-donasi-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DonasiAdd[/{idDonasi}]', DonasiController::class . ':add')->add(PermissionMiddleware::class)->setName('DonasiAdd-donasi-add'); // add
    $app->map(["GET","OPTIONS"], '/DonasiView[/{idDonasi}]', DonasiController::class . ':view')->add(PermissionMiddleware::class)->setName('DonasiView-donasi-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DonasiEdit[/{idDonasi}]', DonasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('DonasiEdit-donasi-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DonasiDelete[/{idDonasi}]', DonasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('DonasiDelete-donasi-delete'); // delete
    $app->group(
        '/donasi',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idDonasi}]', DonasiController::class . ':list')->add(PermissionMiddleware::class)->setName('donasi/list-donasi-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idDonasi}]', DonasiController::class . ':add')->add(PermissionMiddleware::class)->setName('donasi/add-donasi-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idDonasi}]', DonasiController::class . ':view')->add(PermissionMiddleware::class)->setName('donasi/view-donasi-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idDonasi}]', DonasiController::class . ':edit')->add(PermissionMiddleware::class)->setName('donasi/edit-donasi-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idDonasi}]', DonasiController::class . ':delete')->add(PermissionMiddleware::class)->setName('donasi/delete-donasi-delete-2'); // delete
        }
    );

    // donatur
    $app->map(["GET","POST","OPTIONS"], '/DonaturList[/{idDonatur}]', DonaturController::class . ':list')->add(PermissionMiddleware::class)->setName('DonaturList-donatur-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/DonaturAdd[/{idDonatur}]', DonaturController::class . ':add')->add(PermissionMiddleware::class)->setName('DonaturAdd-donatur-add'); // add
    $app->map(["GET","OPTIONS"], '/DonaturView[/{idDonatur}]', DonaturController::class . ':view')->add(PermissionMiddleware::class)->setName('DonaturView-donatur-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/DonaturEdit[/{idDonatur}]', DonaturController::class . ':edit')->add(PermissionMiddleware::class)->setName('DonaturEdit-donatur-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/DonaturDelete[/{idDonatur}]', DonaturController::class . ':delete')->add(PermissionMiddleware::class)->setName('DonaturDelete-donatur-delete'); // delete
    $app->group(
        '/donatur',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idDonatur}]', DonaturController::class . ':list')->add(PermissionMiddleware::class)->setName('donatur/list-donatur-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idDonatur}]', DonaturController::class . ':add')->add(PermissionMiddleware::class)->setName('donatur/add-donatur-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idDonatur}]', DonaturController::class . ':view')->add(PermissionMiddleware::class)->setName('donatur/view-donatur-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idDonatur}]', DonaturController::class . ':edit')->add(PermissionMiddleware::class)->setName('donatur/edit-donatur-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idDonatur}]', DonaturController::class . ':delete')->add(PermissionMiddleware::class)->setName('donatur/delete-donatur-delete-2'); // delete
        }
    );

    // jabatan
    $app->map(["GET","POST","OPTIONS"], '/JabatanList[/{idJabatan}]', JabatanController::class . ':list')->add(PermissionMiddleware::class)->setName('JabatanList-jabatan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/JabatanAdd[/{idJabatan}]', JabatanController::class . ':add')->add(PermissionMiddleware::class)->setName('JabatanAdd-jabatan-add'); // add
    $app->map(["GET","OPTIONS"], '/JabatanView[/{idJabatan}]', JabatanController::class . ':view')->add(PermissionMiddleware::class)->setName('JabatanView-jabatan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/JabatanEdit[/{idJabatan}]', JabatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('JabatanEdit-jabatan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/JabatanDelete[/{idJabatan}]', JabatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('JabatanDelete-jabatan-delete'); // delete
    $app->group(
        '/jabatan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idJabatan}]', JabatanController::class . ':list')->add(PermissionMiddleware::class)->setName('jabatan/list-jabatan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idJabatan}]', JabatanController::class . ':add')->add(PermissionMiddleware::class)->setName('jabatan/add-jabatan-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idJabatan}]', JabatanController::class . ':view')->add(PermissionMiddleware::class)->setName('jabatan/view-jabatan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idJabatan}]', JabatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('jabatan/edit-jabatan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idJabatan}]', JabatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('jabatan/delete-jabatan-delete-2'); // delete
        }
    );

    // kegiatan
    $app->map(["GET","POST","OPTIONS"], '/KegiatanList[/{idKegiatan}]', KegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('KegiatanList-kegiatan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KegiatanAdd[/{idKegiatan}]', KegiatanController::class . ':add')->add(PermissionMiddleware::class)->setName('KegiatanAdd-kegiatan-add'); // add
    $app->map(["GET","OPTIONS"], '/KegiatanView[/{idKegiatan}]', KegiatanController::class . ':view')->add(PermissionMiddleware::class)->setName('KegiatanView-kegiatan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KegiatanEdit[/{idKegiatan}]', KegiatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('KegiatanEdit-kegiatan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KegiatanDelete[/{idKegiatan}]', KegiatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('KegiatanDelete-kegiatan-delete'); // delete
    $app->group(
        '/kegiatan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idKegiatan}]', KegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('kegiatan/list-kegiatan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idKegiatan}]', KegiatanController::class . ':add')->add(PermissionMiddleware::class)->setName('kegiatan/add-kegiatan-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idKegiatan}]', KegiatanController::class . ':view')->add(PermissionMiddleware::class)->setName('kegiatan/view-kegiatan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idKegiatan}]', KegiatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('kegiatan/edit-kegiatan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idKegiatan}]', KegiatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('kegiatan/delete-kegiatan-delete-2'); // delete
        }
    );

    // kontakajuanproyek
    $app->map(["GET","POST","OPTIONS"], '/KontakajuanproyekList[/{kontak:.*}]', KontakajuanproyekController::class . ':list')->add(PermissionMiddleware::class)->setName('KontakajuanproyekList-kontakajuanproyek-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KontakajuanproyekAdd[/{kontak:.*}]', KontakajuanproyekController::class . ':add')->add(PermissionMiddleware::class)->setName('KontakajuanproyekAdd-kontakajuanproyek-add'); // add
    $app->map(["GET","OPTIONS"], '/KontakajuanproyekView[/{kontak:.*}]', KontakajuanproyekController::class . ':view')->add(PermissionMiddleware::class)->setName('KontakajuanproyekView-kontakajuanproyek-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KontakajuanproyekEdit[/{kontak:.*}]', KontakajuanproyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('KontakajuanproyekEdit-kontakajuanproyek-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KontakajuanproyekDelete[/{kontak:.*}]', KontakajuanproyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('KontakajuanproyekDelete-kontakajuanproyek-delete'); // delete
    $app->group(
        '/kontakajuanproyek',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{kontak:.*}]', KontakajuanproyekController::class . ':list')->add(PermissionMiddleware::class)->setName('kontakajuanproyek/list-kontakajuanproyek-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{kontak:.*}]', KontakajuanproyekController::class . ':add')->add(PermissionMiddleware::class)->setName('kontakajuanproyek/add-kontakajuanproyek-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{kontak:.*}]', KontakajuanproyekController::class . ':view')->add(PermissionMiddleware::class)->setName('kontakajuanproyek/view-kontakajuanproyek-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{kontak:.*}]', KontakajuanproyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('kontakajuanproyek/edit-kontakajuanproyek-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{kontak:.*}]', KontakajuanproyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('kontakajuanproyek/delete-kontakajuanproyek-delete-2'); // delete
        }
    );

    // kontakanggota
    $app->map(["GET","POST","OPTIONS"], '/KontakanggotaList[/{kontak:.*}]', KontakanggotaController::class . ':list')->add(PermissionMiddleware::class)->setName('KontakanggotaList-kontakanggota-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KontakanggotaAdd[/{kontak:.*}]', KontakanggotaController::class . ':add')->add(PermissionMiddleware::class)->setName('KontakanggotaAdd-kontakanggota-add'); // add
    $app->map(["GET","OPTIONS"], '/KontakanggotaView[/{kontak:.*}]', KontakanggotaController::class . ':view')->add(PermissionMiddleware::class)->setName('KontakanggotaView-kontakanggota-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KontakanggotaEdit[/{kontak:.*}]', KontakanggotaController::class . ':edit')->add(PermissionMiddleware::class)->setName('KontakanggotaEdit-kontakanggota-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KontakanggotaDelete[/{kontak:.*}]', KontakanggotaController::class . ':delete')->add(PermissionMiddleware::class)->setName('KontakanggotaDelete-kontakanggota-delete'); // delete
    $app->group(
        '/kontakanggota',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{kontak:.*}]', KontakanggotaController::class . ':list')->add(PermissionMiddleware::class)->setName('kontakanggota/list-kontakanggota-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{kontak:.*}]', KontakanggotaController::class . ':add')->add(PermissionMiddleware::class)->setName('kontakanggota/add-kontakanggota-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{kontak:.*}]', KontakanggotaController::class . ':view')->add(PermissionMiddleware::class)->setName('kontakanggota/view-kontakanggota-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{kontak:.*}]', KontakanggotaController::class . ':edit')->add(PermissionMiddleware::class)->setName('kontakanggota/edit-kontakanggota-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{kontak:.*}]', KontakanggotaController::class . ':delete')->add(PermissionMiddleware::class)->setName('kontakanggota/delete-kontakanggota-delete-2'); // delete
        }
    );

    // kontakdonatur
    $app->map(["GET","POST","OPTIONS"], '/KontakdonaturList[/{kontak:.*}]', KontakdonaturController::class . ':list')->add(PermissionMiddleware::class)->setName('KontakdonaturList-kontakdonatur-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KontakdonaturAdd[/{kontak:.*}]', KontakdonaturController::class . ':add')->add(PermissionMiddleware::class)->setName('KontakdonaturAdd-kontakdonatur-add'); // add
    $app->map(["GET","OPTIONS"], '/KontakdonaturView[/{kontak:.*}]', KontakdonaturController::class . ':view')->add(PermissionMiddleware::class)->setName('KontakdonaturView-kontakdonatur-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KontakdonaturEdit[/{kontak:.*}]', KontakdonaturController::class . ':edit')->add(PermissionMiddleware::class)->setName('KontakdonaturEdit-kontakdonatur-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KontakdonaturDelete[/{kontak:.*}]', KontakdonaturController::class . ':delete')->add(PermissionMiddleware::class)->setName('KontakdonaturDelete-kontakdonatur-delete'); // delete
    $app->group(
        '/kontakdonatur',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{kontak:.*}]', KontakdonaturController::class . ':list')->add(PermissionMiddleware::class)->setName('kontakdonatur/list-kontakdonatur-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{kontak:.*}]', KontakdonaturController::class . ':add')->add(PermissionMiddleware::class)->setName('kontakdonatur/add-kontakdonatur-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{kontak:.*}]', KontakdonaturController::class . ':view')->add(PermissionMiddleware::class)->setName('kontakdonatur/view-kontakdonatur-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{kontak:.*}]', KontakdonaturController::class . ':edit')->add(PermissionMiddleware::class)->setName('kontakdonatur/edit-kontakdonatur-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{kontak:.*}]', KontakdonaturController::class . ':delete')->add(PermissionMiddleware::class)->setName('kontakdonatur/delete-kontakdonatur-delete-2'); // delete
        }
    );

    // kontaktargetproposal
    $app->map(["GET","POST","OPTIONS"], '/KontaktargetproposalList[/{kontak:.*}]', KontaktargetproposalController::class . ':list')->add(PermissionMiddleware::class)->setName('KontaktargetproposalList-kontaktargetproposal-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/KontaktargetproposalAdd[/{kontak:.*}]', KontaktargetproposalController::class . ':add')->add(PermissionMiddleware::class)->setName('KontaktargetproposalAdd-kontaktargetproposal-add'); // add
    $app->map(["GET","OPTIONS"], '/KontaktargetproposalView[/{kontak:.*}]', KontaktargetproposalController::class . ':view')->add(PermissionMiddleware::class)->setName('KontaktargetproposalView-kontaktargetproposal-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/KontaktargetproposalEdit[/{kontak:.*}]', KontaktargetproposalController::class . ':edit')->add(PermissionMiddleware::class)->setName('KontaktargetproposalEdit-kontaktargetproposal-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/KontaktargetproposalDelete[/{kontak:.*}]', KontaktargetproposalController::class . ':delete')->add(PermissionMiddleware::class)->setName('KontaktargetproposalDelete-kontaktargetproposal-delete'); // delete
    $app->group(
        '/kontaktargetproposal',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{kontak:.*}]', KontaktargetproposalController::class . ':list')->add(PermissionMiddleware::class)->setName('kontaktargetproposal/list-kontaktargetproposal-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{kontak:.*}]', KontaktargetproposalController::class . ':add')->add(PermissionMiddleware::class)->setName('kontaktargetproposal/add-kontaktargetproposal-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{kontak:.*}]', KontaktargetproposalController::class . ':view')->add(PermissionMiddleware::class)->setName('kontaktargetproposal/view-kontaktargetproposal-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{kontak:.*}]', KontaktargetproposalController::class . ':edit')->add(PermissionMiddleware::class)->setName('kontaktargetproposal/edit-kontaktargetproposal-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{kontak:.*}]', KontaktargetproposalController::class . ':delete')->add(PermissionMiddleware::class)->setName('kontaktargetproposal/delete-kontaktargetproposal-delete-2'); // delete
        }
    );

    // partisipasikegiatan
    $app->map(["GET","POST","OPTIONS"], '/PartisipasikegiatanList[/{keys:.*}]', PartisipasikegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('PartisipasikegiatanList-partisipasikegiatan-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PartisipasikegiatanAdd[/{keys:.*}]', PartisipasikegiatanController::class . ':add')->add(PermissionMiddleware::class)->setName('PartisipasikegiatanAdd-partisipasikegiatan-add'); // add
    $app->map(["GET","OPTIONS"], '/PartisipasikegiatanView[/{keys:.*}]', PartisipasikegiatanController::class . ':view')->add(PermissionMiddleware::class)->setName('PartisipasikegiatanView-partisipasikegiatan-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PartisipasikegiatanEdit[/{keys:.*}]', PartisipasikegiatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PartisipasikegiatanEdit-partisipasikegiatan-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PartisipasikegiatanDelete[/{keys:.*}]', PartisipasikegiatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('PartisipasikegiatanDelete-partisipasikegiatan-delete'); // delete
    $app->group(
        '/partisipasikegiatan',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', PartisipasikegiatanController::class . ':list')->add(PermissionMiddleware::class)->setName('partisipasikegiatan/list-partisipasikegiatan-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', PartisipasikegiatanController::class . ':add')->add(PermissionMiddleware::class)->setName('partisipasikegiatan/add-partisipasikegiatan-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', PartisipasikegiatanController::class . ':view')->add(PermissionMiddleware::class)->setName('partisipasikegiatan/view-partisipasikegiatan-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', PartisipasikegiatanController::class . ':edit')->add(PermissionMiddleware::class)->setName('partisipasikegiatan/edit-partisipasikegiatan-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', PartisipasikegiatanController::class . ':delete')->add(PermissionMiddleware::class)->setName('partisipasikegiatan/delete-partisipasikegiatan-delete-2'); // delete
        }
    );

    // partisipasiproyek
    $app->map(["GET","POST","OPTIONS"], '/PartisipasiproyekList[/{keys:.*}]', PartisipasiproyekController::class . ':list')->add(PermissionMiddleware::class)->setName('PartisipasiproyekList-partisipasiproyek-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/PartisipasiproyekAdd[/{keys:.*}]', PartisipasiproyekController::class . ':add')->add(PermissionMiddleware::class)->setName('PartisipasiproyekAdd-partisipasiproyek-add'); // add
    $app->map(["GET","OPTIONS"], '/PartisipasiproyekView[/{keys:.*}]', PartisipasiproyekController::class . ':view')->add(PermissionMiddleware::class)->setName('PartisipasiproyekView-partisipasiproyek-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/PartisipasiproyekEdit[/{keys:.*}]', PartisipasiproyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('PartisipasiproyekEdit-partisipasiproyek-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/PartisipasiproyekDelete[/{keys:.*}]', PartisipasiproyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('PartisipasiproyekDelete-partisipasiproyek-delete'); // delete
    $app->group(
        '/partisipasiproyek',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', PartisipasiproyekController::class . ':list')->add(PermissionMiddleware::class)->setName('partisipasiproyek/list-partisipasiproyek-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', PartisipasiproyekController::class . ':add')->add(PermissionMiddleware::class)->setName('partisipasiproyek/add-partisipasiproyek-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', PartisipasiproyekController::class . ':view')->add(PermissionMiddleware::class)->setName('partisipasiproyek/view-partisipasiproyek-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', PartisipasiproyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('partisipasiproyek/edit-partisipasiproyek-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', PartisipasiproyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('partisipasiproyek/delete-partisipasiproyek-delete-2'); // delete
        }
    );

    // proyek
    $app->map(["GET","POST","OPTIONS"], '/ProyekList[/{idProyek}]', ProyekController::class . ':list')->add(PermissionMiddleware::class)->setName('ProyekList-proyek-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ProyekAdd[/{idProyek}]', ProyekController::class . ':add')->add(PermissionMiddleware::class)->setName('ProyekAdd-proyek-add'); // add
    $app->map(["GET","OPTIONS"], '/ProyekView[/{idProyek}]', ProyekController::class . ':view')->add(PermissionMiddleware::class)->setName('ProyekView-proyek-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ProyekEdit[/{idProyek}]', ProyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProyekEdit-proyek-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ProyekDelete[/{idProyek}]', ProyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProyekDelete-proyek-delete'); // delete
    $app->group(
        '/proyek',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idProyek}]', ProyekController::class . ':list')->add(PermissionMiddleware::class)->setName('proyek/list-proyek-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idProyek}]', ProyekController::class . ':add')->add(PermissionMiddleware::class)->setName('proyek/add-proyek-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idProyek}]', ProyekController::class . ':view')->add(PermissionMiddleware::class)->setName('proyek/view-proyek-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idProyek}]', ProyekController::class . ':edit')->add(PermissionMiddleware::class)->setName('proyek/edit-proyek-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idProyek}]', ProyekController::class . ':delete')->add(PermissionMiddleware::class)->setName('proyek/delete-proyek-delete-2'); // delete
        }
    );

    // targetproposal
    $app->map(["GET","POST","OPTIONS"], '/TargetproposalList[/{idTargetProposal}]', TargetproposalController::class . ':list')->add(PermissionMiddleware::class)->setName('TargetproposalList-targetproposal-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/TargetproposalAdd[/{idTargetProposal}]', TargetproposalController::class . ':add')->add(PermissionMiddleware::class)->setName('TargetproposalAdd-targetproposal-add'); // add
    $app->map(["GET","OPTIONS"], '/TargetproposalView[/{idTargetProposal}]', TargetproposalController::class . ':view')->add(PermissionMiddleware::class)->setName('TargetproposalView-targetproposal-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/TargetproposalEdit[/{idTargetProposal}]', TargetproposalController::class . ':edit')->add(PermissionMiddleware::class)->setName('TargetproposalEdit-targetproposal-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/TargetproposalDelete[/{idTargetProposal}]', TargetproposalController::class . ':delete')->add(PermissionMiddleware::class)->setName('TargetproposalDelete-targetproposal-delete'); // delete
    $app->group(
        '/targetproposal',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{idTargetProposal}]', TargetproposalController::class . ':list')->add(PermissionMiddleware::class)->setName('targetproposal/list-targetproposal-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{idTargetProposal}]', TargetproposalController::class . ':add')->add(PermissionMiddleware::class)->setName('targetproposal/add-targetproposal-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{idTargetProposal}]', TargetproposalController::class . ':view')->add(PermissionMiddleware::class)->setName('targetproposal/view-targetproposal-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{idTargetProposal}]', TargetproposalController::class . ':edit')->add(PermissionMiddleware::class)->setName('targetproposal/edit-targetproposal-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{idTargetProposal}]', TargetproposalController::class . ':delete')->add(PermissionMiddleware::class)->setName('targetproposal/delete-targetproposal-delete-2'); // delete
        }
    );

    // users
    $app->map(["GET","POST","OPTIONS"], '/UsersList[/{_username:.*}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UsersAdd[/{_username:.*}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->map(["GET","OPTIONS"], '/UsersView[/{_username:.*}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UsersEdit[/{_username:.*}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UsersDelete[/{_username:.*}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('UsersDelete-users-delete'); // delete
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{_username:.*}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{_username:.*}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{_username:.*}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{_username:.*}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{_username:.*}]', UsersController::class . ':delete')->add(PermissionMiddleware::class)->setName('users/delete-users-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsList[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsList-userlevelpermissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsAdd[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsAdd-userlevelpermissions-add'); // add
    $app->map(["GET","OPTIONS"], '/UserlevelpermissionsView[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsView-userlevelpermissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsEdit[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsEdit-userlevelpermissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelpermissionsDelete[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsDelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsList[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsAdd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->map(["GET","OPTIONS"], '/UserlevelsView[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelsView-userlevels-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsEdit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/UserlevelsDelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->map(["GET","POST","OPTIONS"], '/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // register
    $app->map(["GET","POST","OPTIONS"], '/register', OthersController::class . ':register')->add(PermissionMiddleware::class)->setName('register');

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
        Route_Action($app);
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
