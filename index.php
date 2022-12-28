<div id="root">
  <h1>Vanilla JS - Two way binding using Proxy</h1>
  <div class="form-group">
    <div class="form-elements">
      Name: <input id="xd" acebind="username" type="text" />
      <br/>
      <span acebind="username"></span>
      <br/><br/>
      Email: <input acebind="email" type="text"/>
      <br/>
      <span acebind="email"></span>
    </div>
    <div class="button-group">
      <button onclick="log()">Inspect Scope</button>
      <button onclick="changeUsernameByCode()">Change Username Scope</button>
      <button onclick="changeEmailByCode()">Change Email Scope</button>
    </div>
  </div>
  
  <div id="debug-container">
    <button id="btnClearLog" title="Clear logs" onclick="clear_logs()">x</button>
    <pre id="debug">
    </pre>
  </div>
</div>



<script>

let elms = document.querySelectorAll("[acebind]");
let allowTypes = ["text", "textarea", "number", "password", "submit", "email", "search", "url"];
let scope = {};  // stores data

 
const handler = {
  get: function(obj, prop) {
    return obj[prop] ;
  },
  set: function(obj, prop, value) {

    let currentElems = document.querySelectorAll("[acebind]");

    obj[prop] = value;
    currentElems.forEach((elm) => {//find all ocurrences of the acebind in html and update it with value

      if (elm.getAttribute("acebind") == prop) {


        if (elm.type && allowTypes.includes(elm.type)) {
          elm.value = value;
        } else if (!elm.type) {
          elm.innerText = value;
        }
      }
    })

    return true; // indicates success
  }
};

scope = new Proxy(scope, handler);

elms.forEach((elm) => {
  if (allowTypes.includes(elm.type)) {

    let propToBind = elm.getAttribute("acebind");
    elm.addEventListener("keyup", (e) => {
      scope[propToBind] = elm.value;  // fires handler (set method) proxy 

    });
  }
});
 

// Outputs the JSON structuree of scope 
const log = function () {
  Object.keys(scope).forEach((k) => {
    debug.innerHTML += JSON.stringify(scope) + "<br/>";
  });
  debug.scrollTop = debug.scrollHeight;
}

// Change the username scope on click of the button
const changeUsernameByCode = function () {
  scope.username = "username Changed by Code";
}

// Change the email scope on click of the button
const changeEmailByCode = function () {
  scope.email = "email changed by Code";

  console.log(scope)

}



const clear_logs = function(){

    debug.innerHTML = ""

}



/**
 * Bind Keyup listener to element in DOM with acebind attribute 
 * @param {array} attributes
 * @param {string} target
 * element = DOM Element
 * target = "root"
 */ 

const bindKeyUpEle = (element)=>{

if(element.hasAttribute("acebind")){

  if (allowTypes.includes(element.type)) {
  let propToBind = element.getAttribute("acebind");
  element.addEventListener("keyup", (e) => {


      scope[propToBind] = element.value;  // proxy set method fires

    });

  }
}


  
}




/**
 * Add Elements to DOM
 * @param {array} attributes
 * @param {string} target
 * element = [{id:"example", type:"text", class:"myclass", acebind:"model", parent:"", el: "div"}] 
 * target = "root"
 */ 
 
const addEle = (element, target)=>{

if (typeof target === "string" || target instanceof String)
target = document.getElementById(target);

if(!target){

console.error(`parent target: ${target} doesn't exists`);

}

element.forEach(elm=> {

let ele = document.createElement(elm.el);


//bind all atttributes to element

for (const [p, val] of Object.entries(elm)) {

    if(p!=="parent" && p!=="el")
    ele.setAttribute(`${p}`, `${val}`);



} 

bindKeyUpEle(ele);


if(elm["parent"]){ //append below element parent if has this property


const parent = target.querySelectorAll(`#${elm.parent}`);

if(parent.length > 0)
parent[0].appendChild(ele);
else
console.error(`parent id: #${elm.parent} doesn't found`);

}
else{ //append to the parent target

target.appendChild(ele);

}



});



}


addEle([{class:"d-none", id: "div-parent", el:"div"},
        {type:"text", class:"d-none", id: "input-child", el:"input", acebind:"model", parent:"div-parent"},
        {type:"text", class:"d-none", id: "input-child-1", el:"input", acebind:"model", parent:"div-parent"},
        {class:"d-none", id: "label-1", el:"label", acebind:"model", parent:"div-parent"}], debug);




</script>

