document.querySelector('#Select_item').addEventListener('change',function(){
    const selectedValue = this.value;    
    let Size_quanity  = document.querySelector('#Size_quanity')    
    let Tshirt_Size_quanity = document.querySelector('#Tshirt_Size_quanity')
    if(selectedValue == 3){
        Size_quanity.classList.remove('hidden')
        Tshirt_Size_quanity.classList.add('hidden')

        console.log('HEllo');
    }else if(selectedValue == 1){
        Tshirt_Size_quanity.classList.remove('hidden')
        Size_quanity.classList.add('hidden')
    }
    else{
        Size_quanity.classList.add('hidden')
        console.log('World');
    }
})


