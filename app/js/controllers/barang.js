app.controller('appbarangCtrl', function ($scope, Data, toaster, FileUploader,$modal) {
    var kode_unik = new Date().getUTCMilliseconds() + "" + (Math.floor(Math.random() * (20 - 10 + 1)) + 10);
    //init data
    var tableStateRef;
    var nmcontroller = "appbarang";
    $scope.displayed = [];
    $scope.form = {};
    $scope.is_edit = false;
    $scope.is_view = false;


    $scope.callServer = function callServer(tableState) {
        tableStateRef = tableState;

        $scope.isLoading = true;
        var offset = tableState.pagination.start || 0;
        var limit = tableState.pagination.number || 10;
        var param = {offset: offset, limit: limit};

        if (tableState.sort.predicate) {
            param['sort'] = tableState.sort.predicate;
            param['order'] = tableState.sort.reverse;
        }
        if (tableState.search.predicateObject) {
            param['filter'] = tableState.search.predicateObject;
        }

        Data.get(nmcontroller + '/index', param).then(function (data) {
            $scope.displayed = data.data;
            tableState.pagination.numberOfPages = Math.ceil(data.totalItems / limit);
        });

        $scope.isLoading = false;
    };

    Data.get(nmcontroller + '/satlist').then(function (data) {
        $scope.listsatuan = data.satuan;
    });

    $scope.cariBrand = function ($query) {

        if ($query.length >= 3) {
            Data.get('appbrand/cari', {nama: $query}).then(function (data) {

                $scope.listbrand = data.data;
            });
        }
    }
    $scope.cariCategory = function ($query) {

        if ($query.length >= 3) {
            Data.get(nmcontroller + '/catsrc', {nama: $query}).then(function (data) {

                $scope.listcat = data.data;
            });
        }
    }


    $scope.create = function (form) {
        $scope.is_edit = true;
        $scope.is_create = true;
        $scope.is_view = false;
        $scope.formtitle = "Form Tambah Data";
        $scope.form = {};
       
        $scope.gambar = [];
    };
    $scope.update = function (form) {
        
        $scope.is_edit = true;
        $scope.is_create = false;
        $scope.is_view = false;
        $scope.formtitle = "Edit Data : " + form.name;
        $scope.form = form;
        $scope.gambar = form.listfoto;
    };
    $scope.view = function (form) {
        $scope.is_edit = true;
        $scope.is_create = false;
        $scope.is_view = true;
        $scope.formtitle = "Lihat Data : " + form.name;
        $scope.form = form;
        $scope.gambar = form.listfoto;
        
    };
    $scope.save = function (form) {
        if ($scope.uploader.queue.length > 0) {
            $scope.uploader.uploadAll();
            form.foto = kode_unik + "-" + $scope.uploader.queue[0].file.name;
        } else {
            form.foto = '';
        }

        var url = (form.id > 0) ? nmcontroller + '/update/' + form.id : nmcontroller + '/create/';
        Data.post(url, form).then(function (result) {
            if (result.status == 0) {
                toaster.pop('error', "Terjadi Kesalahan", result.errors);
            } else {
                $scope.is_edit = false;
                $scope.callServer(tableStateRef); //reload grid ulang
                toaster.pop('success', "Berhasil", "Data berhasil tersimpan");
            }
        });
    };

    //============================GAMBAR===========================//
    var uploader = $scope.uploader = new FileUploader({
        url: Data.base +nmcontroller + '/upload.html?folder=product',
        formData: [],
        removeAfterUpload: true,
    });

    $scope.uploadGambar = function (form) {
        $scope.uploader.uploadAll();
    };

    uploader.filters.push({
        name: 'imageFilter',
        fn: function (item) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            var x = '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            if (!x) {
                toaster.pop('error', "Jenis gambar tidak sesuai");
            }
            return x;
        }
    });

    uploader.filters.push({
        name: 'sizeFilter',
        fn: function (item) {
            var xz = item.size < 2097152;
            if (!xz) {
                toaster.pop('error', "Ukuran gambar tidak boleh lebih dari 2 MB");
            }
            return xz;
        }
    });

    $scope.gambar = [];

    uploader.onSuccessItem = function (fileItem, response) {
        if (response.answer == 'File transfer completed') {
            $scope.gambar.unshift({img: response.img,id : response.id});
//            $scope.form.foto = $scope.gambar;
        }
    };

    uploader.onBeforeUploadItem = function (item) {
        item.formData.push({
            id: $scope.form.id,
        });
    };

    $scope.removeFoto = function (paramindex, namaFoto, pid) {
        Data.post(nmcontroller +'/removegambar', {id: pid, img: namaFoto}).then(function (data) {
            $scope.gambar.splice(paramindex, 1);
        });

    };
    $scope.gambarzoom = function (id, img) {
        var modalInstance = $modal.open({
            template: '<img src="img/product/' + id + '-350x350-' + img + '" class="img-full" >',
            size: 'md',
        });
    };
    /* sampe di sini*/
    
    //modal
    $scope.modal = function (form) {
        var data = form;
        data.is_create = $scope.is_create;
        var modalInstance = $modal.open({
            templateUrl: 'tpl/m_barang/modal.html',
            controller: 'modalCtrl',
            size: 'lg',
            backdrop: 'static',
            resolve: {
                form: function () {
                    return data;
                }
            }
        });
    };
    //finish modal

    $scope.cancel = function () {
        $scope.is_edit = false;
        $scope.is_view = false;
    };


    $scope.delete = function (row) {
        if (confirm("Apa anda yakin akan MENGHAPUS PERMANENT item ini ?")) {
             angular.forEach(row.listfoto, function ($value, $key) {
                 $scope.removeFoto($key, $value.img,row.id);
             });
             
            Data.delete(nmcontroller + '/delete/' + row.id).then(function (result) {
                $scope.displayed.splice($scope.displayed.indexOf(row), 1);
            });
            
            
        }
    };


});

app.controller('modalCtrl', function ($scope, Data, $modalInstance, form) {

   var nmcontroller = "appbarang";

    $scope.formmodal = form;

    $scope.save = function (formmodal) {
        var data = {
            form: formmodal,
        };

        var url =  nmcontroller+'/updatedetail';
        Data.post(url, data).then(function (result) {
//            console.log(data);
            $scope.formmodal = result.data;
            $modalInstance.dismiss('cancel');
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
})
