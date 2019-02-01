var $ = require("jquery");
var url = window.location.origin + '/php-boolpress/comments.php';

$(document).ready(function () {
   var getData = window.location.search.substring(1).split('=');
   if(getData[0] === 'slug'){
      $.ajax({
         'url': url,
         'method': 'GET',
         'data': {
            'slug' : getData[1]
         },
         'success': function (data) {
            printComments(JSON.parse(data));
         },
         'error': function (err) {
            console.log('error');
         }
      });
   }
});

function printComments(data) {
   var wrapper = $('.post__comments');
   var titleComments = $('.post__comments__title').clone();
   $(wrapper).append(titleComments);
   for (var i = 0; i < data.length ; i++) {
      //clono template
      var template = $('.template-comment .comment').clone();
      $(template).attr('data-id', data.id);
      var name = $(template).children('.comment__name');
      var email = $(template).find('.comment__email');
      var content = $(template).children('.comment__content');

      //rendo la prima lettera maiuscola
      data[i].name = data[i].name.replace(data[i].name[0], data[i].name[0].toUpperCase());

      //inserisco dati
      $(name).prepend(data[i].name);
      $(email).html(data[i].email);
      $(content).html(data[i].body);
      $(wrapper).append(template);
   }
}