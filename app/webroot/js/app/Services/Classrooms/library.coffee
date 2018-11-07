angular.module 'Pyoopil.Services'
.factory 'libraryService', ['Utilities','CSBase'
  (Utilities, CSBase)->

    new class libraryService extends CSBase

      constructor: ->

        super

      init : (scope)->

        super scope

        @path += @currentClassroom + '/Library/'

        @getUrl = 'getTopicsList.json?page='

        @getCallback = (data)->
          @emit 'READ.Libraries', data

        @getDatum()





]