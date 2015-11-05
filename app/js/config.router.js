angular.module('app')
        .run(
                ['$rootScope', '$state', '$stateParams', 'Data',
                    function ($rootScope, $state, $stateParams, Data) {
                        $rootScope.$state = $state;
                        $rootScope.$stateParams = $stateParams;
                        //pengecekan login
                        $rootScope.$on("$stateChangeStart", function (event, toState) {
                            Data.get('appsite/session').then(function (results) {
                                if (typeof results.data.user != "undefined") {
                                    $rootScope.user = results.data.user;
                                } else {
                                    $state.go("access.signin");
                                }
                            });
                        });
                    }
                ]
                )
        .config(
                ['$stateProvider', '$urlRouterProvider',
                    function ($stateProvider, $urlRouterProvider) {

                        $urlRouterProvider
                                .otherwise('/app/dashboard');
                        $stateProvider
                                .state('app', {
                                    abstract: true,
                                    url: '/app',
                                    templateUrl: 'tpl/app.html'
                                })
                                .state('app.dashboard', {
                                    url: '/dashboard',
                                    templateUrl: 'tpl/dashboard.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {

                                            }]
                                    }
                                })

                                // others
                                .state('access', {
                                    url: '/access',
                                    template: '<div ui-view class="fade-in-right-big smooth"></div>'
                                })
                                .state('access.signin', {
                                    url: '/signin',
                                    templateUrl: 'tpl/page_signin.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/site.js').then(
                                                        );
                                            }]
                                    }
                                })
                                .state('access.404', {
                                    url: '/404',
                                    templateUrl: 'tpl/page_404.html'
                                })
                                .state('access.forbidden', {
                                    url: '/forbidden',
                                    templateUrl: 'tpl/page_forbidden.html'
                                })
                                //master
                                .state('master', {
                                    url: '/master',
                                    templateUrl: 'tpl/app.html'
                                })
                                .state('transaksi', {
                                    url: '/transaksi',
                                    templateUrl: 'tpl/app.html'
                                })
                                // master article
                                .state('master.apparticle', {
                                    url: '/article',
                                    templateUrl: 'tpl/m_apparticle/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('textAngular')
                                                        .then(
                                                                function () {
                                                                    return $ocLazyLoad.load('js/controllers/apparticle.js');
                                                                }
                                                        );
                                            }]
                                    }
                                })
                                //master user
                                .state('master.pengguna', {
                                    url: '/pengguna',
                                    templateUrl: 'tpl/m_user/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/pengguna.js');
                                            }]
                                    }
                                })

                                .state('master.filemanager', {
                                    url: '/filemanager',
                                    templateUrl: 'tpl/filemanager/index.html',
                                })
                                  .state('master.userprofile', {
                                    url: '/profile',
                                    templateUrl: 'tpl/m_user/profile.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/pengguna_profile.js');
                                            }]
                                    }
                                })
                                  .state('master.customer', {
                                    url: '/customer',
                                    templateUrl: 'tpl/m_customer/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/customer.js');
                                            }]
                                    }
                                })
                                  .state('master.pengiriman', {
                                    url: '/pengiriman',
                                    templateUrl: 'tpl/m_pengiriman/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/pengiriman.js');
                                            }]
                                    }
                                })
                                   .state('transaksi.payment', {
                                    url: '/payment',
                                    templateUrl: 'tpl/t_payment/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function ($ocLazyLoad) {
                                                return $ocLazyLoad.load('textAngular')
                                                        .then(
                                                                function () {
                                                                    return $ocLazyLoad.load('js/controllers/payment.js');
                                                                }
                                                        );
                                            }]
                                    }
                                })
                                  .state('master.satuan', {
                                    url: '/satuan',
                                    templateUrl: 'tpl/m_satuan/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/satuan.js');
                                            }]
                                    }
                                })
                                  .state('master.barang', {
                                    url: '/barang',
                                    templateUrl: 'tpl/m_barang/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/barang.js');
                                            }]
                                    }
                                })
                                  .state('transaksi.sell', {
                                    url: '/sell',
                                    templateUrl: 'tpl/t_sell/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/sell.js');
                                            }]
                                    }
                                })
                                  .state('master.merk', {
                                    url: '/merk',
                                    templateUrl: 'tpl/m_merk/index.html',
                                    resolve: {
                                        deps: ['$ocLazyLoad',
                                            function($ocLazyLoad) {
                                                return $ocLazyLoad.load('js/controllers/merk.js');
                                            }]
                                    }
                                })
                                


                    }
                ]
                );
