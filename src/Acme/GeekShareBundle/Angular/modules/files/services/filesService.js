/* 
 * IndexController from errorPage Module
 */

app.registerService(function() {
    var self = this;

    self.moduleName = "files";
    self.serviceName = "$filesService";


    self.initService = function() {
        angular.module(self.moduleName).factory([self.moduleName, self.serviceName].join("."), ['$resource', function($resource) {
                return $resource(app.api.url("files", "resource"), {directory: '@directory'}, {
                    list: {
                        method: 'POST', 
                        url : app.api.url("files", "list")
                    },
                    create: {
                        method: 'PUT', 
                        url : app.api.url("files", "create")
                    },
                    "delete" : {
                        method: 'POST', 
                        url : app.api.url("files", "delete")
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