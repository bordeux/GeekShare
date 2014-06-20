/* 
 * Index page
 */

app.registerModule(function() {
    var self = this;

    self.moduleName = "user";



    self.initModule = function() {
        angular.module(self.moduleName, ['ui.router']);
    };

    /**
     * 
     * @returns {void}
     */
    self.registerRoutes = function() {
        angular.module(self.moduleName).config(['$stateProvider',
            function($stateProvider) {
  
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
                        .state('auth.resetPassword', {
                            url: "/resetPassword",
                            templateUrl: app.assets.template(self.moduleName, "authResetPassword.html")
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
        }
    };
});