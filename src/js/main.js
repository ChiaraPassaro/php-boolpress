var $ = require("jquery");
var url = window.location.origin + '/php-boolpress/comments.php';
var search = {
  'text': undefined,
   'id': 0,
   'pending': false,
   'tags': []
};

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

   var searchForm = $('.filter');
   var searchInput = $('.filter__tag');
   //se scrivo in search
   searchInput.keyup(function(event){
      var text;
      if(event.keyCode !== 46 && event.keyCode !== 8 && event.keyCode !== 13){
         text =  $(this).val();
         if(search.text === undefined){
            search.text = text;
            search.id++;
            search.pending = true;
            getTags(search.text);
            /*console.log('prima');
            console.log(search.text);
            console.log(search.pending);*/
         } else {
            /*console.log('seconda');
            console.log(text);
            console.log(search.pending);
            console.log(search.tags);*/
            var lastFilteredTags = searchTag(search.tags, text);
            printSuggestions(lastFilteredTags);
            //console.log(lastFilteredTags);
         }
      } else {
         text = $(this).val();
         if(text.length === 0){
            console.log('lenght 0');
            search.id = 0;
            search.text = undefined;
            printSuggestions();
         } else {
            search.text = text;
            //console.log(search.tags);
            var filteredTags = searchTag(search.tags, text);
            printSuggestions(filteredTags);
            //console.log(filteredTags);
         }
      }
      if (event.keyCode === 13){
         event.preventDefault();
         searchForm.submit();
      }

   });


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

function getTags(text) {
   var url = window.location.origin + '/php-boolpress/tags.php';
   $.ajax({
      'url': url,
      'method': 'GET',
      'data': {
         'tag': text
      },
      'success': function (data) {
         search.tags = JSON.parse(data);
         search.pending = false;
         printSuggestions(search.tags);
      },
      'error': function (err) {
         console.log('error');
      }
   });
}

function searchTag(tags, text) {
   var filteredTags = [];
   for (var i = 0; i < tags.length; i++) {
      if(tags[i].includes(text)){
         filteredTags.push(tags[i])
      }
   }
   return filteredTags;
}

function printSuggestions(data) {
   var wrapper = $('.autocomplete__suggestions');
   if(!data){
      wrapper.html('');
   } else {
      wrapper.html('');
      var suggestion =  $('<option class="autocomplete_suggestion">');
      for (var i = 0; i < data.length; i++) {
         var thisSuggestion = suggestion.clone();
         thisSuggestion.attr('value', data[i]);
         wrapper.append(thisSuggestion);
      }
   }
}

