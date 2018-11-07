angular.module 'Pyoopil.Services'
.factory 'announcementService', ['Utilities','CSBase'
  (Utilities, CSBase)->

    new class announcementService extends CSBase

      constructor: ->

        super

      init : (scope)->

        super scope

        @path += @currentClassroom + '/Announcements/'

        @getUrl = 'getannouncements.json?page='

        @getCallback = (data)->
          @emit 'READ.Announcements', data

        @getDatum()


      postForm : (data)->

        url = 'add.json'

        super url, data, (data)



]