/* 
 * IndexController from errorPage Module
 */

app.registerService(function() {
    var self = this;

    self.moduleName = "files";
    self.serviceName = "$uploaderService";


    self.initService = function() {
        angular.module(self.moduleName).provider(
                [self.moduleName, self.serviceName].join("."), function() {
           
            var $element = angular.element("<files-uploader>");
            var $body = angular.element("body");
            $body.append($element);
            

                    
            this.$get = ["$compile", "$rootScope", function($compile, $rootScope) {
                  
            }];
        });


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