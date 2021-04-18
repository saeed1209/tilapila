<template>
    <div>
        <div v-if="isLoading">Loading players...</div>
        <div v-else>
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>title</th>
                    <th>date</th>

                </tr>
                </thead>
                <tbody>
                <template v-for="delivery in deliveries">
                    <tr v-bind:key="delivery.id">
                        <td>{{ delivery.id }}</td>
                        <td>{{ delivery.title }}</td>
                        <td>{{ delivery.date }}</td>
                    </tr>
                </template>
                </tbody>
            </table>
            <a class="button is-primary">Add Player</a>
        </div>
    </div>
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
<style scoped>
.drop-zone {
    background-color: #eee;
    margin-bottom: 10px;
    padding: 10px;
}

.drag-el {
    background-color: #fff;
    margin-bottom: 10px;
    padding: 5px;
}

</style>
<script>
import axios from 'axios'
import { API_BASE_URL } from "../config"

export default {
    async created () {
        try {
            const response = await axios.get(API_BASE_URL + '/deliveries')
            console.log(response.data.data)
            this.deliveries = response.data.data

            this.isLoading = false
        } catch (e) {
        }
    },

    data () {
        return {
            items: [
                {
                    id: 0,
                    title: 'Item A',
                    list: 1
                },
                {
                    id: 1,
                    title: 'Item B',
                    list: 1
                },
                {
                    id: 2,
                    title: 'Item C',
                    list: 2
                }]
        }
    },
    computed: {
        listOne () {
            return this.items.filter(item => item.list === 1)
        },
        listTwo () {
            return this.items.filter(item => item.list === 2)
        }
    },
    startDrag: (evt, item) => {
        evt.dataTransfer.dropEffect = 'move'
        evt.dataTransfer.effectAllowed = 'move'
        evt.dataTransfer.setData('itemID', item.id)
    },
    onDrop (evt, list) {
        const itemID = evt.dataTransfer.getData('itemID')
        const item = this.items.find(item => item.id == itemID)
        item.list = list
    }
}


</script>
