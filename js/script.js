var imgFeature = document.querySelector('.img-feature');
var listImg = document.querySelectorAll('.list-image img');
var preBtn = document.querySelector('.pre');
var nextBtn = document.querySelector('.next');

var currentIdx = 0;

function updateImageByIndex(idx){
    //remove active class
    document.querySelectorAll('.list-image div').forEach(item=>{
        item.classList.remove('active')
    })
    
    currentIdx = idx;
    imgFeature.src = listImg[idx].getAttribute('src');
    listImg[idx].parentElement.classList.add('active');
}

listImg.forEach((imgElement, idx)=>{
    imgElement.addEventListener('click', e=>{
        updateImageByIndex(idx)
    }) 
})

preBtn.addEventListener('click', e=>{
    if(currentIdx == 0){
        currentIdx = listImg.length -1
    }else{
        currentIdx--
    }
    updateImageByIndex(currentIdx);
})

nextBtn.addEventListener('click', e=>{
    if(currentIdx == listImg.length -1){
        currentIdx = 0
    }else{
        currentIdx++
    }
    updateImageByIndex(currentIdx);
})


updateImageByIndex(0);