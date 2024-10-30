(function() {


for(var i=0;i<document.getElementsByTagName('p').length;i++){
   if(document.getElementsByTagName('p')[i].className == 'lh-paragraph-id'){
var id = document.getElementsByTagName('p')[i].getAttribute("id"); 
var fragment = "#" + id;
var node = document.createElement("a");                 // Create a <a> node
node.setAttribute("href", fragment);
node.setAttribute("title", "Link to this paragraph");
node.setAttribute("class", "lh-paragraph-id-anchor");
var textnode = document.createTextNode('\u00B6');         // Create a text node
node.appendChild(textnode);   

var span = document.createElement("span");                 // Create a <span> node 
//var textnode = document.createEntityReference('nbsp');        // Create a text node 
span.appendChild( document.createTextNode( '\u00A0' ) );
span.appendChild(node);

document.getElementsByTagName('p')[i].appendChild(span);
   }
}

})();