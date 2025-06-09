const product =[
    {image:"https://m.media-amazon.com/images/I/5144aElwYRL._AC_UY218_.jpg",name:"Xbox One S",price:290},
    {image:"https://m.media-amazon.com/images/I/615YaAiA-ML._AC_UY218_.jpg",name:"Oculus Quest 2",price:362},
    {image:"https://m.media-amazon.com/images/I/71u4nQGNenL._AC_UL640_QL65_.jpg",name:"Razer Enki Gaming Chair",price:499},
    {image:"https://m.media-amazon.com/images/I/7185qYEwIEL._AC_UL640_QL65_.jpg",name:"Headphone",price:199}
];
const categories = [...new Set(product.map((item)=>{return item;}))];
let i=0;
document.getElementById("root").innerHTML = categories.map((item)=>{
    var {image,name,price}=item;
    return(`
    <div class="box">
        <div class="img-box">
            <img class="image" src="${image}" alt="">
        </div>
        <div class="button">
            <p>${name}</p>
            <h2>${price}</h2>
            <button onclick='addtocard(${i++})'>Add to Cart</button>
        </div>
    </div>
    `);
}).join("");
const cart = [];
// document.getElementById("foot").style.display="none";
function addtocard(a){
    cart.push({...categories[a]});
    displaycart();
}
function DelElement(a) {
    cart.splice(a,1);
    displaycart();
}
function displaycart(){
    let j=0,total=0 , totalItem = [] ;
    document.getElementById("count").innerHTML = cart.length;
    if(cart.length == 0){
        document.getElementById("cartItem").innerHTML = "Your cart is empty";
        document.getElementById("total").innerHTML = "$"+total+".00";
        // document.getElementById("foot").style.display="none";
        totalItem = [];
        const cartString = JSON.stringify(totalItem);
        // Set it in a hidden input field
        document.getElementById('txtItem').value = cartString;
    }else{
        document.getElementById("foot").style.display="flex";
        document.getElementById("cartItem").innerHTML =cart.map((item)=>{
            var{image,name,price}=item;
            let quantity=1;
            totalItem.push({name , quantity , price});

            total=total+price;
            document.getElementById("total").innerHTML = "$"+total+".00";
            const cartString = JSON.stringify(totalItem);
            // Set it in a hidden input field
            document.getElementById('txtItem').value = cartString;
            return(`
            <div class="cart-item">
                <div class="row-img">
                    <img class="rowimg" src="${image}" alt="">
                </div>
                <p style='font-size: 20px;'>${name}</p>
                <h2 style='font-size: 20px;'>${price}</h2>
                <i class="fa-solid fa-trash-can" onclick='DelElement(${j++})'></i>
            </div>
            `);
        }).join("");
    }
}

