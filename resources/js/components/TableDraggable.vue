<template>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>title</th>
            <th>date</th>
            <th>route</th>
            <th>position</th>
            <th>action</th>
            <th>sort</th>
        </tr>
        </thead>
        <draggable :list="deliveriesNew" :options="{animate:200,handle:'.my-handle'}" :element="'tbody'" @change="update">
            <tr v-for="(delivery,index) in deliveriesNew ">
                <td>{{ delivery.id }}</td>
                <td>{{ delivery.title}}</td>
                <td>{{ delivery.date}}</td>
                <td>{{ delivery.route_id}}</td>
                <td>{{ delivery.position}}</td>
                <td>
                    <a :href="'deliveries/' + delivery.id+'/edit'" class="btn btn-success">edit</a><br/>
                    <form :action="'deliveries/' + delivery.id+'/edit'" method="post">

                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" :value="csrf">
                        <button type="submit">delete</button>
                    </form>
                </td>
                <td>
                    <a class="fa fa-arrows my-handle">move</a>
                </td>
            </tr>

        </draggable>
    </table>
</template>

<template>
    <div>
        <div class='drop-zone' @drop='onDrop($event, 1)'>
            <div
                v-for='item in listOne'
                :key='item.title'
                @dragstart='startDrag($event, item)'
                class='drag-el'
            >
                {{ item.title }}
            </div>
        </div>
        <div class='drop-zone' @drop='onDrop($event, 1)'
             @dragover.prevent
             @dragenter.prevent>
            <div class='drag-el'
                 v-for='item in listTwo'
                 :key='item.title'
                 draggable
                 @dragstart='startDrag($event, item)' >
                {{ item.title }}
            </div>
        </div>
    </div>
</template>
<script>
import draggable from 'vuedraggable';
export default {
    components:{
        draggable
    },

    props:['deliveries'],

    data(){
        return {
            deliveriesNew:this.deliveries,
            csrf:document.head.querySelector('meta[name="csrf-token"]').content
        }
    },
    methods:{
        update(){
            this.deliveriesNew.map((delivery,index)=>{
                delivery.position = index+1
            })
            axios.patch('api/v1/routes',{
                deliveries:this.deliveriesNew
            }).then((response)=>{
                console.log(response)
            })
            //console.log('update')
        }
    },
    mounted(){
        console.log('table')
    }
}
</script>
