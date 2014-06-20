/**
 * 
 * @type object
 */
app = {
    
    /**
     * Registered modules
     * @type Array
     */
    modules: [],
    
    /**
     * Registered controllers
     * @type Array
     */
    controllers: [],
    
    /**
     * Registered Services
     * @type Array
     */
    services: [],
    
    /**
     * Registered directives
     * @type Array
     */
    directives: [],
    
    /**
     * Registered factories
     * @type Array
     */
    factories: [],
    
    /**
     * Registered filters
     * @type Array
     */
    filters: [],
    
    /**
     * Config object
     * @type object
     */
    config : {},
    
    /**
     * Default requrements
     * @type Array
     */
    appRequires : [
        "ui.router"
    ],
    
    /**
     * Set config from System (Urls, version , host itp)
     * @param {object} config
     * @returns {app@pro;configconfig}
     */
    setConfig : function(config){
        return this.config = config;
    },
    
    /**
     * Get config. ex. app.getConfig("urls.template");
     * @param {string} param
     * @returns {@arr;lastVal|app.getConfig.lastVal|@param;app.setConfig|object}
     */
    getConfig : function(param){
        if(typeof param === "undefined"){
            return this.config;
        }
        var keys = param.split(".");
        var lastVal = this.config;
        for(var i in keys){
            var key = keys[i];
            if(typeof lastVal === "undefined"){
                return null;
            }
            lastVal = lastVal[key];
        }
        
       return lastVal;
    },
    
    /**
     * Default config for Module
     * @returns {app.getDefaultModuleConfig.Anonym$0}
     */
    getDefaultModuleConfig : function(){
        return {
            name : "",
            appRequires : [],
            bootstrap : function(){}
        };
    },
    /**
     * Default config for Controller
     * @returns {app.getDefaultControllerConfig.Anonym$1}
     */
    getDefaultControllerConfig : function(){
        return {
            name : "",
            appRequires : [],
            bootstrap : function(){}
        };
    },
    
    /**
     * Default config for Service
     * @returns {app.getDefaultServiceConfig.Anonym$2}
     */
    getDefaultServiceConfig : function(){
        return {
            name : "",
            appRequires : [],
            bootstrap : function(){}
        };
    },
    
    /**
     * Default config for Filter
     * @returns {app.getDefaultServiceConfig.Anonym$2}
     */
    getDefaultFilterConfig : function(){
        return {
            name : "",
            appRequires : [],
            bootstrap : function(){}
        };
    },
    
    /**
     * Default config for factory
     * @returns {app.getDefaultFactoryConfig.Anonym$2}
     */
    getDefaultFactoryConfig : function(){
        return {
            name : "",
            appRequires : [],
            bootstrap : function(){}
        };
    },
    
    /**
     * Default config for Directive
     * @returns {app.getDefaultDirectiveConfig.Anonym$3}
     */
    getDefaultDirectiveConfig : function(){
        return {
            name : "",
            appRequires : [],
            bootstrap : function(){}
        };
    },
    
    
    /**
     * Register module function
     * @param {app.getDefaultModuleConfig.Anonym$0} config
     * @returns {undefined}
     */
    registerModule : function(config){
        if(typeof config === "function"){
            config  = new config();
        }
       
        var moduleConfig = $.extend(true, this.getDefaultModuleConfig(), config);
        this.modules.push(moduleConfig);
    },
    
    /**
     * Register factory function
     * @param {app.getDefaultServiceConfig.Anonym$2} config
     * @returns {undefined}
     */
    registerFactory: function(config){
        if(typeof config === "function"){
            config  = new config();
        }
        var serviceConfig = $.extend(true, this.getDefaultFactoryConfig(), config);
        this.factories.push(serviceConfig);
    },
    
    /**
     * Register service function
     * @param {app.getDefaultServiceConfig.Anonym$2} config
     * @returns {undefined}
     */
    registerService: function(config){
        if(typeof config === "function"){
            config  = new config();
        }
        var serviceConfig = $.extend(true, this.getDefaultServiceConfig(), config);
        this.services.push(serviceConfig);
    },
    
    /**
     * Register directive function
     * @param {app.getDefaultDirectiveConfig.Anonym$3} config
     * @returns {undefined}
     */
    registerDirective : function(config){
        if(typeof config === "function"){
            config  = new config();
        }
        var directiveConfig = $.extend(true, this.getDefaultDirectiveConfig(), config);
        this.directives.push(directiveConfig);
    },
    
    /**
     * Register controller function
     * @param {app.getDefaultControllerConfig.Anonym$1} config
     * @returns {undefined}
     */
    registerController : function(config){
        if(typeof config === "function"){
            config  = new config();
        }
        var controllerConfig = $.extend(true, this.getDefaultControllerConfig(), config);
        this.controllers.push(controllerConfig);
    },
    
    /**
     * Register filter function
     * @param {app.getDefaultControllerConfig.Anonym$1} config
     * @returns {undefined}
     */
    registerFilter : function(config){
        if(typeof config === "function"){
            config  = new config();
        }
        var filterConfig = $.extend(true, this.getDefaultFilterConfig(), config);
        this.filters.push(filterConfig);
    },
    
    
    /**
     * Init AngularJS main Module (app)
     * @returns {Boolean}
     */
    initAngular : function(){
        for(var i in this.modules){
            var moduleConfig = this.modules[i];
            this.appRequires = this.appRequires.concat(moduleConfig.appRequires);
            moduleConfig.bootstrap();
        }
        
        angular.module('app', this.appRequires);
        return true;
    },
    
    /**
     * Initialize Controllers
     * @returns {Boolean}
     */
    initControllers : function(){
        for(var i in this.controllers){
            var controllerConfig = this.controllers[i];
            controllerConfig.bootstrap();
        }
        return true;
    },
    
    /**
     * Initialize Services
     * @returns {Boolean}
     */
    initServices : function(){
        for(var i in this.services){
            var serviceConfig = this.services[i];
            serviceConfig.bootstrap();
        }
        return true;
    },
    
    /**
     * Initialize directives
     * @returns {Boolean}
     */
    initDirectives : function(){
        for(var i in this.directives){
            var directiveConfig = this.directives[i];
            directiveConfig.bootstrap();
        }
        return true;
    },
    
    /**
     * Initialize directives
     * @returns {Boolean}
     */
    initFilters : function(){
        for(var i in this.filters){
            var filterConfig = this.filters[i];
            filterConfig.bootstrap();
        }
        return true;
    },
    
    /**
     * Initialize directives
     * @returns {Boolean}
     */
    initFactories : function(){
        for(var i in this.factories){
            var factoryConfig = this.factories[i];
            factoryConfig.bootstrap();
        }
        return true;
    },
    
    
    
    /**
     * Changing tags in AngularJS from {{example}} to [[example]]
     * @returns {undefined}
     */
    initInterpolate : function(){
        angular.module('app').config(['$interpolateProvider', function ($interpolateProvider) {
            //$interpolateProvider.startSymbol('[[');
            // $interpolateProvider.endSymbol(']]');
        }]);
    },
    
    
    /**
     * Changing tags in AngularJS from {{example}} to [[example]]
     * @returns {undefined}
     */
    initRouting : function(){
        angular.module('app').config(['$locationProvider', function ($locationProvider) {
            $locationProvider.hashPrefix('!');
            $locationProvider.html5Mode(true);
        }]);
    },
    
    
    /**
     * Changing tags in AngularJS from {{example}} to [[example]]
     * @returns {undefined}
     */
    initOther : function(){
        angular.module('ui.bootstrap.carousel', ['ui.bootstrap.transition'])
            .controller('CarouselController', ['$scope', '$timeout', '$transition', '$q', function        ($scope, $timeout, $transition, $q) {
        }]).directive('carousel', [function() {
            return {

            };
        }]);
    },
    
    cacheTemplates : function($templateCache){
        if(typeof angularModulesViews == "undefined"){
            return;
        };
        
        for(var moduleName in angularModulesViews){
            for(var viewName in angularModulesViews[moduleName]){
                $templateCache.put(app.assets.template(moduleName, viewName), angularModulesViews[moduleName][viewName]);
            }
        }
    },
    
    __run : function(){
        var self = this;
        angular.module('app').run(['$rootScope', '$templateCache', function($rootScope, $templateCache) {
            console.log("Application started!");
            $rootScope.app = {};
            $rootScope.app.functions = {};
            self.cacheTemplates($templateCache);
        }]);
    },
    
    /**
     * Run all initializes
     * @returns {undefined}
     */
    run: function(){
        this.initAngular();
        this.initControllers();
        this.initDirectives();
        this.initServices();
        this.initFactories();
        this.initFilters();

        this.initInterpolate();
        this.initRouting();
        this.initOther();
        this.__run();
       
    }
};


/**
 * Class to getting URLS to assets
 * @type type
 */
app.assets = {
    /**
     * Get template URL, ex app.assets.template('footer", "index/index.html")
     * @param {string} module
     * @param {string} src
     * @returns {string}
     */
    template : function(module, src){
        var url = app.getConfig("urls.templates");
        return ([url, module, src]).join("/");
    },
    css : function(css){
        var url = app.getConfig("urls.css");
        return ([url, css]).join("/");
    },
    lib : function(name, file){
        var url = app.getConfig("urls.lib");
        return ([url, name, file]).join("/");
    }
};


/**
 * Class to getting URLS to API
 * @type type
 */
app.api = {
    url : function(module, action){
        var url = app.getConfig("urls.api");
        return [url, module, action].join("/");
    }
};