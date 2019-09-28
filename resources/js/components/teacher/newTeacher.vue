<template>
<div id="new-teacher">
  <div class="container pdt-6">
    <div class="row m-y-2">
        <div class="col-md-12">
            <h4 class="m-y-2 text-center mb-5 tab-content">ADD MY TEACHER</h4>
        </div>
        <div class="col-lg-4 pull-lg-8 text-xs-center">
            <div v-if="loadding" class="loadding-avt">
                <div class="loader"></div>
            </div>
            <img :src="teacher.image ||'//placehold.it/150'" class="m-x-auto img-fluid img-circle" alt="avatar">
            <h6 class="m-t-2">Upload a different photo</h6>
            <label class="custom-file">
                <input type="file" @change="onFileChange($event)" id="file" class="custom-file-input">
                <span class="custom-file-control  btn btn-primary">Choose file</span>
            </label>
        </div>
        <div class="col-lg-8 push-lg-4">
            <div class="tab-pane" id="edit">
                <form role="form" @submit.prevent="addTeacher">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Tên</label>
                        <div class="col-lg-9">
                            <input v-model="teacher.name" class="form-control" type="text" placeholder="Jane">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Số điện thoại</label>
                        <div class="col-lg-9">
                            <input v-model="teacher.phone" class="form-control" type="text" placeholder="0123456789">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input v-model="teacher.email" class="form-control" type="text" placeholder="example@example.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Ngày sinh</label>
                        <div class="col-lg-9">
                            <input v-model="teacher.birthday" class="form-control" type="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Giới tính</label>
                        <div class="col-lg-9">
                            <select id="user_time_zone" v-model="teacher.gender" class="form-control" size="0">
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                        <div class="col-lg-9">
                            <input  v-model="teacher.address" class="form-control" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Chuyên môn</label>
                        <div class="col-lg-9">
                            <input v-model="teacher.specialize" class="form-control" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Mô tả</label>
                        <div class="col-lg-9">
                            <textarea v-model="teacher.description" name="description" class="form-control"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label"></label>
                        <div class="col-lg-9">
                            <input type="reset" class="btn btn-secondary" value="Cancel">
                            <input type="submit" class="btn btn-primary" value="Add my teacher">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
</template>
<script>
import { post } from '../../helpers/api'
import noty from '../../helpers/noty'
import { postTeacher,uploadFile } from '../../router/router'
export default {
    name: 'app-new-teacher',
    data(){
        return{
            teacher:{
                name:'',
                birthday:'',
                gender:'',
                address:'',
                specialize:'',
                description:'',
                phone:'',
                image:'',
                email:''
            },
            loadding : false
        }
    },
    methods:{
        addTeacher(){
            // this.$validator.ValidateAll().then((res)=>{
                this.$Progress.start()
                post(postTeacher ,this.teacher ).then((res)=>{
                    const message = res.data.message
                    noty({type: 'success', text: message, force: true})
                    this.$Progress.finish()
                }).catch(err=>{
                    noty({type: 'error', text: "Don't create your teacher", force: true})
                    this.$Progress.fail()
                })

            // })
        },

        onFileChange(event){
            this.loadding = true;
            let formData = new FormData()
            $.each(event.currentTarget.files, (i, file) => {
                formData.append('file', file)
            })
            post(uploadFile,formData)
            .then(res=>{
                this.teacher.image = 'images/'+res.data
                this.loadding = false;
            })
            .catch((err) =>{
                console.log(err)
            })
        },

    }
}
</script>
<style>
.m-x-auto.img-fluid.img-circle{
    width:150px;
    height:150px;
}
.loadding-avt {
    height: 150px;
    width: 150px;
}

.custom-file-input{
    display: none;
}
</style>
