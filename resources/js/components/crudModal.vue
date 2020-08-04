<template>
  <transition name="fade-modal">
    <div class="cart-modal-container" v-if="showModal" >
      <div class="hide-cart-modal" @click="hideModal()"></div>
      <div class="cart-modal">
      <div class="modal-header"><h3>ویرایش</h3></div>
        <div class="modal-main">
          <input class="modal-input" type="text" placeholder="نام" v-model="name" required>
          <textarea class="modal-input" v-model="describe" rows="8" cols="50" placeholder="توضیحات" required></textarea>
          <input class="modal-input" type="number" placeholder="تعداد" v-model="quanity" required>
          <input class="modal-input" type="number" placeholder="قیمت" v-model="price" required>
          <input type="file" placeholder="عکس" @change="onFileSelected">
          
        </div>
        <div class="modal-footer">
          <div class="button-cancel" @click="hideModal">انصراف</div>
          <div class="button-save" @click="postData">ذخیره</div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
name:'crudModal',
props: {
  showModal: {
    type: Boolean,
    required: true,
    default: false
  },
  crudModalUpdate : {
    type: Boolean,
    required: true,
    default: false
  },
  crudData: {
    type:Object ,
    required:true,
  }
},

data () {
  return {
    name : '',
    describe : '',
    quanity : '',
    price : '',
    selectedImage : null,
    imageName : '',
    errors : '',
  }
},


methods: {

  hideModal () {
    this.$emit('hideModal')  ;
  },

  DataChange () {
    this.crudData.name = this.name;
    this.crudData.description = this.describe;
    this.crudData.units = this.quanity;
    this.crudData.price = this.price;
    this.$emit('DataChange',this.crudData);
  },

  onFileSelected(event) {
    this.selectedImage = event.target.files;
    this.imageName = event.target.files[0].name;
  },

  postData() {
    if( this.name == '' || this.describe == '' || this.quanity == '' || this.price == '' ) {
      this.errors = 'لطفا همه ی فیلد ها را پر کنید'
    }
    else {
      if (this.crudModalUpdate)
      {
        axios.post('/api/admin/product/update',{
          'id' : this.crudData.id,
          'name' : this.name,
          'describe' : this.describe,
          'quanity' : this.quanity,
          'price' : this.price,
          'image' : this.selectedImage,
          'imageName' : this.imageName
          }).then (x => {
            this.DataChange();
            this.hideModal();
          })
          .catch (err => {
          // this.errors = err[0];
            console.log(err);
          });
      }
      else {
          axios.post('/api/admin/product/add',{
          'name' : this.name,
          'describe' : this.describe,
          'quanity' : this.quanity,
          'price' : this.price,
          'image' : this.selectedImage,
          'imageName' : this.imageName
          }).then (x => {
          this.hideModal();
          })
          .catch (err => {
          // this.errors = err[0];
          console.log(err);
          });
      }
      
    }
  
  }

},
watch: {
  errors: function(val) {
    alert(val);
    val = '';
  },

  crudModalUpdate: function(val) {
    if (val) {
      this.name = this.crudData.name;
      this.describe = this.crudData.description;
      this.quanity = this.crudData.units;
      this.price = this.crudData.price;
    }
  }
}

}
</script>

<style>


.modal-header {
  background-color: #6c7ae0;
  color: #fff;
  height: 2.4rem;
}

.modal-main {
  flex-grow: 1;
}

.modal-input {
  display: block;
  height: 50px;
  width: 30%;
  margin: 1rem auto;
  border: none;
}
.modal-input::placeholder {
  -webkit-transform: translateY(0px);
  transform: translateY(0px);
  -webkit-transition: .5s;
  transition: .5s;
}
.modal-input:hover, .modal-input:focus, .modal-input:active:focus {
  color: #ff5722;
  outline: none;
  border-bottom: 1px solid #ff5722;
}

.modal-input:hover::placeholder, .modal-input:focus::placeholder, .modal-input:active:focus::placeholder {
  color: #ff5722;
  position: relative;
  -webkit-transform: translateY(-20px);
  transform: translateY(-20px);
}

.modal-main textarea {
  display: block;
  width: 80%;
  margin: 0 auto;
  border: 1px solid #eceff5;
}

.modal-main textarea::placeholder {
  text-align: center;
  height: 50%;
}


.modal-footer {
  text-align: end;
  height: 3rem;
}

.modal-footer .button-save{
  margin: 0 1rem;
  display: inline-block;
  background-color: #6c7ae0;
  color: #fff;
  width: 4rem;
  height: 2rem;
  text-align: center;
  cursor: pointer;
}

.modal-footer .button-cancel {
  display: inline-block;
  margin: 0 1rem;
  width: 4rem;
  height: 2rem;
  text-align: center;
  cursor: pointer;
  border: 1px solid #010107;
}

</style>