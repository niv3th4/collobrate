angular.module 'Pyoopil.Services'
.factory 'peopleService', ['Utilities','CSBase'
  (Utilities, CSBase)->

    new class PeopleService extends CSBase

      constructor: ->

        super

      init : (scope)->

        super scope

        @getUrl = 'getpeople.json.json?page='

        @path += @currentClassroom + '/People/'

        @getCallback = (data)->
#          console.log data
          @emit 'READ.Peoples', data

        @getDatum()

      postForm : (url, data, cb)=>

        if angular.isDefined cb
          @getCallback = cb
        else
          @getCallback = (data) -> @emit 'READ.Peoples', data

        super url, data, (data)

]