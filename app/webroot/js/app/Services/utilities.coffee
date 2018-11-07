angular.module 'Pyoopil.Services'
.factory 'Utilities', ['$document', 'EventEmitter', '$window', ($document, EventEmitter, $window)->

  new class Utilities extends EventEmitter

    constructor : ->

      @modalPath = '/pyoopil/js/app/partials/overlays/'
      @currentModal = false
      @_body = angular.element $document[0].body


    init : (scope)->

      super scope

      @$scope.template = {}
      @$scope.showModal = false

    openModal : (template) ->

      @$scope.template.url = @modalPath + template + '.html'
      @$scope.showModal = true

      if not @$scope.$$phase
        @$scope.$digest()

      @_body.on 'click', '.close-link', (e) => e.preventDefault(); @closeModal e

      @emit 'openModal'

    closeModal : (e) ->

      @$scope.template.url = null
      @$scope.showModal = true

      @emit 'closeModal'

      if not @$scope.$$phase
        @$scope.$digest()

    getPath : ->

      $window.location.origin + $window.location.pathname

]