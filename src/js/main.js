var $ = require("jquery");
var url = window.location.origin + '/php-boolpress/comments.php';

//creo obj search per conservare dati chiamata ajax
var search = {
   'ajax': undefined,
   'text': undefined,
   'pending': false,
   'tags': []
};

$(document).ready(function () {
   var getData = window.location.search.substring(1).split('=');

   //chiamata ajax per visualizzare commenti
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


   var $searchForm = $('.filter');
   var $searchInput = $('.filter__tag');
   //se scrivo in search
   $searchInput.keyup(function(event){
      var text;
      //se premo un tasto qualunque che non sia enter, delete and backspace
      if(event.keyCode !== 46 && event.keyCode !== 8 && event.keyCode !== 13){
         //prendo il valore dell'input
         text =  $(this).val();
         //se search.text è undefined
         if(search.text === undefined){
            if(search.pending){
               //blocco chiamata precedente
               search.ajax.abort();
               /*console.log('controllo che sia abortita');
               console.log(search.ajax);*/
               //Salvo testo
               search.text = text;
               //setto su pending
               search.pending = true;
               //chiamo funzione getTags per fae chiamata ajax e prendere tutti i tag che iniziano con quella prima lettera
               getTags(search.text);
            } else {
               //Salvo testo
               search.text = text;
               //setto su pending
               search.pending = true;
               //chiamo funzione getTags per fae chiamata ajax e prendere tutti i tag che iniziano con quella prima lettera
               getTags(search.text);
            }
         } else {
            //se è una lettera successiva allora filtro tra i tag già memorizzati in search.tags
            var lastFilteredTags = searchTag(search.tags, text);
            //stampo i risultati filtrandoli ulteriormente
            printSuggestions(lastFilteredTags);
         }
         //se cancello
      } else {
         //riprendo il valore dell'imput
         text = $(this).val();
         //Se l'input è vuoto
         if(text.length === 0){
            //cancello il valore di search.text
            search.text = undefined;
            //richiamo printSuggestions per cancellare i suggerimenti
            printSuggestions();
         } else {
            //altrimenti setto il nuovo valore di search.text
            search.text = text;
            //richiamo la funzione che filtra dai tag già memorizzati
            var filteredTags = searchTag(search.tags, text);
            printSuggestions(filteredTags);
         }
      }

   });

});

//funzione che stampa i commenti
function printComments(data) {
   var $wrapper = $('.post__comments');
   var $titleComments = $('.post__comments__title').clone();
   $($wrapper).append($titleComments);
   for (var i = 0; i < data.length ; i++) {
      //clono template
      var $template = $('.template-comment .comment').clone();
      $($template).attr('data-id', data.id);
      var $name = $($template).children('.comment__name');
      var $email = $($template).find('.comment__email');
      var $content = $($template).children('.comment__content');

      //rendo la prima lettera maiuscola
      data[i].name = data[i].name.replace(data[i].name[0], data[i].name[0].toUpperCase());

      //inserisco dati
      $($name).prepend(data[i].name);
      $($email).html(data[i].email);
      $($content).html(data[i].body);
      $($wrapper).append($template);
   }
}

//funzione che fa chiamata ajax per generare suggerimenti tag
function getTags(text) {
   var url = window.location.origin + '/php-boolpress/tags.php';
   search.ajax = $.ajax({
      'url': url,
      'method': 'GET',
      'data': {
         'tag': text
      },
      'success': function (data) {

         //memorizzo tags nell'oggetto search
         search.tags = JSON.parse(data);
         //setto pending come false
         search.pending = false;
         //chiamo funzione che stampa tags
         printSuggestions(search.tags);
      },
      'error': function (err) {
         console.log('error');
      }
   });
}

//funzione che filtra tags
function searchTag(tags, text) {
   var filteredTags = [];
   for (var i = 0; i < tags.length; i++) {
      if(tags[i].includes(text)){
         filteredTags.push(tags[i])
      }
   }
   return filteredTags;
}

//funzione che stampa i suggerimenti per l'input
function printSuggestions(data) {
   var $wrapper = $('.autocomplete__suggestions');
   //se non c'è data svuoto il wrapper
   if(!data){
      $wrapper.html('');
   } else { //se c'è svuoto e stampo i suggerimenti
      $wrapper.html('');
      var $suggestion =  $('<option class="autocomplete_suggestion">');
      for (var i = 0; i < data.length; i++) {
         var thisSuggestion = $suggestion.clone();
         thisSuggestion.attr('value', data[i]);
         $wrapper.append(thisSuggestion);
      }
   }
}

