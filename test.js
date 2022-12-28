import {aceBind} from './acebind.js';

export class testCtrl{


    constructor (){

        this.ace = new aceBind();

        this.ace.scope.name = "My name is Jose Ahias";

        this.events();

    }


    events = ()=>{

    let self = this;

    addLastnameBtn.addEventListener("click", ()=>{

        self.ace.addEle(
        [{class:"col-md-6", key: "divLastname", el:"div"},
        {class:"form-control", key: "lastname", el:"input", type:"text", acebind:"lastname", parent:"divLastname"},
        {class:"fw-bold", key: "spanLastname", el:"span", parent:"divLastname", text:"lastname scope: "},
        {class:"fw-normal text-muted", el:"span", acebind:"lastname", parent:"spanLastname"}
        ], infoDiv);


    addLastnameBtn.disabled = true;

    });


    }



    
}

window.testCtrl = new testCtrl();

