/* 
 * Index page
 */

app.registerModule(function() {
    var self = this;

    self.moduleName = "user";



    self.initModule = function() {
        angular.module(self.moduleName, ['ui.router', 'ngResource']);
    };

    /**
     * 
     * @returns {void}
     */
    self.registerRoutes = function() {
        angular.module(self.moduleName).config(['$stateProvider', '$urlRouterProvider',
            function($stateProvider, $urlRouterProvider) {
                $urlRouterProvider.otherwise('/auth/login');
                $stateProvider
                        .state('auth', {
                            url: "/auth",
                            templateUrl: app.assets.template(self.moduleName, "auth.html")
                        })
                        .state('auth.login', {
                            url: "/login",
                            templateUrl: app.assets.template(self.moduleName, "authLogin.html"),
                            controller: "user.authLoginController",
                            resolve: {
                                checkLogin: ["$q", "user.$userService", "$state", function($q, $userService, $state) {
                                        var deferred = $q.defer();
                                        $userService.get().$promise.then(function() {
                                            $state.go("files.list", {directory: "root"});
                                            deferred.reject();
                                        }, function() {
                                            deferred.resolve();
                                        });
                                        return deferred;
                                    }]
                            }
                        })
                        .state('auth.register', {
                            url: "/register",
                            templateUrl: app.assets.template(self.moduleName, "authRegister.html")
                        })
                        .state('auth.logout', {
                            url: "/logout",
                            resolve: {
                                logout: ["user.$userService", "$state", function($userService) {
                                        var promise = $userService.logout().$promise;
                                        $state.go("auth.login");
                                        return promise;
                                    }]
                            }
                        })
                        .state('auth.resetPassword', {
                            url: "/resetPassword",
                            templateUrl: app.assets.template(self.moduleName, "authResetPassword.html")
                        });

                $stateProvider
                        .state('settings', {
                            url: "/settings",
                            resolve: {
                                user: ["user.$userService", function($userService) {
                                        return $userService.get().$promise;
                                    }]},
                            controller: "user.settingsController",
                            templateUrl: app.assets.template(self.moduleName, "settings.html")
                        });

            }]);

    };

    self.initRun = function() {
        angular.module(self.moduleName).run(["$rootScope", "$state", function($rootScope, $state) {
                $rootScope.$on('$stateChangeError', function() {
                    $state.go("auth.login");
                });
            }]);
    };

    /**
     * Return config
     */
    return {
        name: self.moduleName,
        appRequires: [
            self.moduleName
        ],
        bootstrap: function() {
            self.initModule();
            self.registerRoutes();
            self.initRun();
        }
    };
});