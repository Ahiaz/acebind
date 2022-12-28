/*

***ACEBIND LIBRARY****

Simple javascript library to help you to make a two way binding with the dom in easy way with proxy method, and add elements to it with a simple declaration of json.

Created by: Jose Ahias Vargas Pacheco

*/


export class aceBind{
    
constructor(){
 
    this.init();

}



init = ()=>{

    let self = this;

    let elms = document.querySelectorAll("[acebind]");
    this.allowTypes = ["text", "textarea", "number", "password", "submit", "email", "search", "url"];
    this.scope = {};  // stores data
    
    const handler = {
        get: function(obj, prop) {
          return obj[prop] ;
        },
        set: function(obj, prop, value) {
      
          let currentElems = document.querySelectorAll("[acebind]");
      
          obj[prop] = value;
          currentElems.forEach((elm) => {//find all ocurrences of the acebind in html and update it with value
      
            if (elm.getAttribute("acebind") == prop) {
      
      
              if (elm.type && self.allowTypes.includes(elm.type)) {
                elm.value = value;
              } else if (!elm.type) {
                elm.innerText = value;
              }
            }
          })
      
          return true;
        }
      };
      
      self.scope = new Proxy(self.scope, handler);
      
      elms.forEach((elm) => {
        if (self.allowTypes.includes(elm.type)) {
      
          let propToBind = elm.getAttribute("acebind");
          elm.addEventListener("keyup", (e) => {
            self.scope[propToBind] = elm.value;  // fires handler (set method) proxy 
      
          });
        }
      });



}







    /**
     * Bind Keyup listener to element in DOM with acebind attribute 
     * @param {HTMLElement} element -> HTMLElement with acebind attribute
     */ 

    bindKeyUpEle = (element)=>{

    let self = this;

    if(element.hasAttribute("acebind")){
    
      if (self.allowTypes.includes(element.type)) {
      let propToBind = element.getAttribute("acebind");
      element.addEventListener("keyup", (e) => {

     
    
        self.scope[propToBind] = element.value;  // proxy set method fires
    
        });
    
      }
    }
    
    
      
    }
    
    
    /**
     * Add Elements to DOM
     * @param {HTMLElement} target -> element parent
     * @param {array} element -> json array  [{key:"example-div", id:"myDiv class:"myclass", el: "div"},{key:"example-input", type:"text", class:"myclassinput", acebind:"modelanyname", parent:"example-div", el: "input"}] 
     */ 
     
    addEle = (element, target)=>{
    
    if (typeof target === "string" || target instanceof String)
    target = document.getElementById(target);
    
    if(!target){
    
    console.error(`parent target: ${target} doesn't exists`);
    
    }
    
    element.forEach(elm=> {
    
    let ele = document.createElement(elm.el);
    
    
    //bind all atttributes to element
    
    for (const [p, val] of Object.entries(elm)) {
    
        if(p!=="parent" && p!=="el" && p!=="text")
        ele.setAttribute(`${p}`, `${val}`);

        if(p==="text"){

        ele.innerText = `${val}`;

        }
    
    
    
    } 
    
    this.bindKeyUpEle(ele);
    
    
    if(elm["parent"]){ //append below element parent if has this property
    
    const parent = target.querySelectorAll(`[key=${elm.parent}]`);


    
    if(parent.length > 0){
    parent[0].appendChild(ele);
    }
    else
    console.error(`parent key: ${elm.parent} doesn't found`);
    
    }
    else{ //append to the parent target
    
    target.appendChild(ele);
 
    }
    
    
    
    });
    
    // remove key attribute to avoid that appears in html
    const removeKeys = target.querySelectorAll(`[key]`);
    removeKeys.forEach(keys => {

    keys.removeAttribute("key");
        
    });
    
    
    }






}

