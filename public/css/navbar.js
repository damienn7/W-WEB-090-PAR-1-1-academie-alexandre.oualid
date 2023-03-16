
class Navbar{
    constructor(element_onclick,count,array=["drop_down","nav_responsive"],element_display){
        this.element_onclick=element_onclick;
        this.count=count;
        this.options=array;
        this.element_display=element_display;
    }

    optionsFunction(){
        if (this.options=["nav_responsive"]) {
            this.onclick(this.element_onclick,this.element_display,this.count);
        }
    }
    
    onclick(onclick,display,count){
        onclick.addEventListener("click",function(event){
            if (count%2==0) {
                count++;
                display.style.display="flex";
            }else{
                count++;
                display.style.display="none";
            }
        })
    }
}
export {Navbar};