## Simple javascript library to help you to make a two way binding with the dom in easy way with proxy method, and add elements to it with a simple declaration of json.

###### How to use:

First copy **acebind.js** file in your project, then import the library in your javascript module

```javascript

import {aceBind} from './acebind.js';

```

Then make a new aceBind instance on constructor class method

```javascript


    constructor (){

        this.ace = new aceBind(); //this will make a bind in all elements in DOM with the attribute "acebind"


    }



```


###### Change element value with 2 way binding:

You need elements in your DOM with the attribute **acebind**

for example supposed that you have the next input and span:

```html

<input id="name" class="form-control" type="text" acebind="name"/>

<span class="fw-bold" acebind="name"></span>

```

You can change the input and span text with the next javascript code:

```javascript

this.ace.scope.name =  "this is a test"; //reflects the value in all dom elements with the attribute "acebind = name"

```

###### Add Elements dinamically with 2 way binding:

Use **addEle** method to append new element to the dom with 2 way binding and using json array to create the elements.

###### Params
**element** = is the json array of elements

**target** = an existing htmElement on DOM, where the element will append it

###### Example:

```javascript

this.ace.addEle(
[{class:"col-md-6", key: "divLastname", el:"div"},
{class:"form-control", key: "lastname", el:"input", type:"text", acebind:"lastname", parent:"divLastname"},
{class:"fw-bold", key: "spanLastname", el:"span", parent:"divLastname", text:"lastname scope: "},
{class:"fw-normal text-muted", el:"span", acebind:"lastname", parent:"spanLastname"}
], infoDiv);

```

###### Relevant attributes

**key:** unique id for append dom elements.

**parent:** indicates that the current element will be append to the element with the especified parent key.

**acebind:** variable name to store the 2 way binding.

**el:** is the html element type, like: div, span, input, label etc...

**text:** set a text for the element, like: p, label, span, h1 etc...

**other atributes:** common values for html elements like: id, class, type, style etc... 


### Work example:

https://hub08.com/ace-bind/test.php







				







