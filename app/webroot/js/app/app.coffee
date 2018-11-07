angular.module('Pyoopil.Constants', [])
angular.module('Pyoopil.Services', [])
angular.module('Pyoopil.Controllers', [])
angular.module('Pyoopil.Directives', [])
angular.module('Pyoopil.Filters', [])

angular
  .module('pyoopil', [
    'ui.router',
    'reCAPTCHA',
    'ngCookies',
    'ngCkeditor',
    'ngSanitize',
    'ui.select2',
    'ngQuickDate',
    'googlechart',
    'angularFileUpload',
    'Pyoopil.Constants',
    'Pyoopil.Services',
    'Pyoopil.Controllers',
    'Pyoopil.Directives',
    'Pyoopil.Filters'
  ])
  .config(['$stateProvider', '$locationProvider', '$urlRouterProvider', '$httpProvider',
    ($stateProvider, $locationProvider, $urlRouterProvider, $httpProvider)->

      $stateProvider
        .state('/', {
          url : '/',
          templateUrl : '/pyoopil/js/app/partials/landing.html'
          authenticate: false
        })
        .state('Views', {
          url : '',
          abstract : true
          templateUrl : '/pyoopil/js/app/partials/overlays/landing.html'
          authenticate: true
        })
        .state('Views.Classrooms', {
            url: '/Classrooms',
            authenticate: true
            views:{
              'nav':{
                templateUrl: '/pyoopil/js/app/partials/overlays/leftNav.html'
              },
              'viewport' : {
                templateUrl : '/pyoopil/js/app/partials/Classrooms/landing.html'
                controller : 'classroomsCtrl'
              }
            }
        })
        .state('Views.Announcements', {
          url: '/Classrooms/announcements',
          authenticate: true
          views:{
            'nav':{
              templateUrl: '/pyoopil/js/app/partials/overlays/leftNav.html'
            },
            'viewport' : {
              templateUrl : '/pyoopil/js/app/partials/Classrooms/announcements.html'
              controller : 'announcementsCtrl'
            }
          }
        })
        .state('Views.Discussions', {
          url: '/Classrooms/Discussions',
          authenticate: true
          views:{
            'nav':{
              templateUrl: '/pyoopil/js/app/partials/overlays/leftNav.html'
            },
            'viewport' : {
              templateUrl : '/pyoopil/js/app/partials/Classrooms/discussions.html'
              controller : 'discussionsCtrl'
            }
          }
        })
        .state('Views.Discussions.Folded', {
          url: '/Classrooms/Discussions/Folded',
          authenticate: true,
          views:{
            'nav':{
              templateUrl: '/pyoopil/js/app/partials/overlays/leftNav.html'
            },
            'viewport' : {
              templateUrl : '/pyoopil/js/app/partials/Classrooms/discussions-folded.html'
              controller : 'discussionsCtrl'
            }
          }
        })
        .state('Views.Library', {
          url: '/Classrooms/Library',
          authenticate: true
          views:{
            'nav':{
              templateUrl: '/pyoopil/js/app/partials/overlays/leftNav.html'
            },
            'viewport' : {
              templateUrl : '/pyoopil/js/app/partials/Classrooms/libraries.html'
              controller : 'libraryCtrl'
            }
          }
        })
        .state('Views.People', {
          url: '/Classrooms/People',
          authenticate: true
          views:{
            'nav':{
              templateUrl: '/pyoopil/js/app/partials/overlays/leftNav.html'
            },
            'viewport' : {
              templateUrl : '/pyoopil/js/app/partials/Classrooms/peoples.html'
              controller : 'peopleCtrl'
            }
          }
        })
        .state('reset', {
          url : '/reset',
          authenticate: false
          templateUrl : '/pyoopil/js/app/partials/reset-password.html'
        })
        .state('logout', {
          url : '/logout',
          authenticate: false
          templateUrl : '/pyoopil/js/app/partials/logout.html',
          controller : 'logoutCtrl'
        })

      $urlRouterProvider.otherwise('/')

      # $httpProvider.interceptors.push('AuthInterceptor')

  ])
  .config(['reCAPTCHAProvider', (reCAPTCHAProvider)->

    reCAPTCHAProvider.setPublicKey('6LeO9fcSAAAAAMsp8vSGpYd8ZHDdcHxvXrZHGf6q')

  ])
  .run(['$rootScope', '$state', '$stateParams', 'Auth', '$location',($rootScope, $state, $stateParams, Auth, $location)->

    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;

    # $state.go 'Views.Classrooms'

    # $rootScope.$on('$stateChangeStart',  (event, toState, toParams, fromState, fromParams) ->
    #   if toState.url is '/'
    #     Auth.authorize((isLoggedIn)->
    #       if isLoggedIn
    #         $state.go 'Views.Classrooms'
    #     )
    #   else
    #     if toState.authenticate
    #       Auth.authorize((isLoggedIn)->
    #         if not isLoggedIn
    #           $state.go 'Views.Classrooms'
    #       )
    # )

    false

  ])
  .factory('AuthInterceptor', ['$rootScope', '$q', '$cookieStore', '$location',
    ($rootScope, $q, $cookieStore, $location)->

      new class AuthInterceptor

        request : (config)->

          config.headers = config.headers or {}

          config.headers['X-AuthTokenHeader'] = $cookieStore.get 'token'

          config


        responseError : (response) ->

          if response.status is 403
            $cookieStore.remove 'token'
            $location.path('/classrooms')
            $q.reject response
          else
            $q.reject response
  ])
  .value('googleChartApiConfig', {
    version: '1',
    optionalSettings: {
      packages: ['corechart'],
      language: 'fr'
    }
  })