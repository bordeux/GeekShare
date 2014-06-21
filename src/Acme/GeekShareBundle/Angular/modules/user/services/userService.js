/* 
 * IndexController from errorPage Module
 */

app.registerService(function() {
    var self = this;

    self.moduleName = "user";
    self.serviceName = "$userService";


    self.initService = function() {


        angular.module(self.moduleName).factory([self.moduleName, self.serviceName].join("."), ['$q', '$resource', function($q, $resource) {
                return $resource(app.api.url("user", "resource"), {email: '@email'}, {
                    create: {
                        method: 'PUT', 
                        url : app.api.url("user", "create")
                    },
                    login: {
                        method: 'PUT', 
                        url : app.api.url("user", "login")
                    },
                    get: {
                        method: 'GET', 
                        url : app.api.url("user", "getUser")
                    },
                    logout: {
                        method: 'GET', 
                        url : app.api.url("user", "logout")
                    }
                });
            }]);


    };


    /**
     * Return config
     */
    return {
        name: self.moduleName,
        serviceName: self.serviceName,
        bootstrap: function() {
            self.initService();
        }
    };
});