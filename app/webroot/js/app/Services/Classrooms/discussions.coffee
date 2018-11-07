angular.module 'Pyoopil.Services'
.factory 'discussionService', ['Utilities','CSBase'
  (Utilities, CSBase)->

    new class discussionService extends CSBase

      constructor: ->
        super

      init : (scope)->

        super scope

        @path += @currentClassroom + '/Discussions/'
        @getUrl = 'getdiscussions.json?page='
        @getCallback = (data)->
          console.log data
          @emit 'READ.Discussions', data

        @getDatum()


      postForm : (url, data, cb)=>

        if angular.isDefined cb
          @getCallback = cb
        else
          @getCallback = (data) -> @emit 'READ.Discussions', data

        super url, data, (data)



]