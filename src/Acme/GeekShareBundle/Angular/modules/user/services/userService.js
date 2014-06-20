/* 
 * IndexController from errorPage Module
 */

app.registerService(function() {
    var self = this;

    self.moduleName = "user";
    self.serviceName = "$userService";
    

    self.initService = function(){
        
        
        angular.module(self.moduleName).factory([self.moduleName, self.serviceName].join("."), ['$q', '$resource', function($q, $resource) {
            return $resource(app.api.url("user", "resource")+'/:email', {id: '@email'});
        }]);

    
    };
  
  
    /**
     * Return config
     */
    return {
        name: self.moduleName,
        serviceName : self.serviceName,
        bootstrap: function() {
            self.initService();
        }
    };
});