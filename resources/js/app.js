import Swiper, { Navigation, Pagination } from 'swiper';
import Axios from 'axios';
Swiper.use([Navigation, Pagination]);
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

const productPhotoInput = `<hr><br><input type="file" name="photo[]"><br>
                          <label>Alt:</label>
                          <input type="text" name="image_alt[]" class="form-control">`;

const addPhotoButton = document.querySelector('#add-product-photo');
const productPhotoInputsArea = document.querySelector('#product-photo-inputs-area');

if (addPhotoButton) {
    addPhotoButton.addEventListener("click", () => {
    productPhotoInputsArea.insertAdjacentHTML('beforeend', productPhotoInput);
    });
}

const swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  
  document.querySelectorAll('.add-to-cart-button').forEach((button) => {
    button.addEventListener("click", () => {
    const form = button.closest('.form');
    const route = form.querySelector('[name=route]').value;
    const id = form.querySelector('[name=product_id]').value;
    const count = form.querySelector('[name=count]').value;

    axios.post(route, {
      product_id: id,
      count: count
    })
    .then(function(response) {        
      const cart = document.querySelector('#mini-cart');
      cart.innerHTML = response.data.html;
      console.log(response);
    })
    .catch(function(error) {
      console.log(error);
    })

    });
  })
  
