angular.module 'Pyoopil.Services'
  .factory 'classroomService', ['Utilities','CSBase'
  (Utilities, CSBase)->

    new class ClassroomService extends CSBase

      constructor: ->

        super

      init : (scope)->

        super scope

        @getUrl = 'getclassrooms.json?page='

        @getCallback = (data)->
          @emit 'READ.Classrooms', data

        @getDatum()

      postForm : (url, data, cb)=>

        if angular.isDefined cb
          @getCallback = cb
        else
          @getCallback = (data) -> @emit 'READ.Classrooms', data

        super url, data, (data)

      setCurrentClassroom : (id)->

        super id
  ]