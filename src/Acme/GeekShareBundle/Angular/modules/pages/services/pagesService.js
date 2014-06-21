/* 
 * IndexController from errorPage Module
 */

app.registerService(function() {
    var self = this;

    self.moduleName = "pages";
    self.serviceName = "$pagesService";


    self.initService = function() {
        angular.module(self.moduleName).factory([self.moduleName, self.serviceName].join("."), ['$resource', function($resource) {
                return $resource(app.api.url("files", "resource"), {name: '@name'}, {
                    get: {
                        method: 'GET', 
                        url : app.api.url("pages", "get")
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