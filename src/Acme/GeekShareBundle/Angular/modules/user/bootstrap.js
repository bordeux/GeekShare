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
                            templateUrl: app.assets.template(self.moduleName, "authLogin.html")
                        })
                        .state('auth.register', {
                            url: "/register",
                            templateUrl: app.assets.template(self.moduleName, "authRegister.html")
                        })
                        .state('auth.logout', {
                            url: "/logout",
                            templateUrl: app.assets.template(self.moduleName, "authLogin.html"),    
                            resolve: {
                                logout : ["user.$userService", function($userService) {
                                        return $userService.logout().$promise;
                                    }]
                            }
                        })
                        .state('auth.resetPassword', {
                            url: "/resetPassword",
                            templateUrl: app.assets.template(self.moduleName, "authResetPassword.html")
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