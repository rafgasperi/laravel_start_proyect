<template>

    <div class="dv">
        <div class="dv-header">
            <div class="dv-header-columns">
                <div v-if="show_new" class="dv-header-new">
                    <a class="btn btn-primary" v-bind:href="show_new+'/'+'create'"><font-awesome-icon icon="plus" />Nuevo</a>
                </div>
                <span class="dv-header-pre">Buscar: </span>
                <select class="dv-header-select form-control" v-model="query.search_column">
                    <option v-for="(column,index) in columns" :value="column">{{labels[index]}}</option>
                </select>
            </div>
            <div class="dv-header-operators">
                <select class="dv-header-select form-control" v-model="query.search_operator">
                    <option v-for="(value, key) in operators" :value="key">{{value}}</option>
                </select>
            </div>
            <div class="dv-header-search">
                <input type="text" class="dv-header-input form-control"
                       placeholder="Buscar"
                       v-model="query.search_input"
                       @keyup.enter="fetchIndexData()">
            </div>
            <div class="dv-header-submit">
                <button class="dv-header-btn btn btn-primary"@click="fetchIndexData()">Filtrar</button>
            </div>
        </div>
        <div class="dv-body">
            <table class="table datatable table-bordered table-striped table-actions">
                <thead>
                <tr>
                    <th v-for="(column,index) in columns" @click="toggleOrder(column)"
                        v-bind:style="[typeof widths[index] !== 'undefined' ? {'width': widths[index]+'%'} : {'width': 'auto'}]">
                         <span v-if="labels[index]">{{labels[index]}}</span>
                         <span v-else>{{column}}</span>
                         <span class="dv-table-column" v-if="column === query.column">
                            <span v-if="query.direction === 'desc'">&darr;</span>
                            <span v-else>&uarr;</span>
                          </span>
                    </th>
                    <th v-if="show_edit || show_detail || show_delete">
                         Acciones
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(row) in model.data">
                    <td v-for="(value) in row">
                        <p>{{value}}</p>
                    </td>
                    <td v-if="show_edit || show_detail || show_delete">
                        <a v-if="show_detail" v-bind:href="show_detail+'/'+row.id" class="btn btn-primary"><font-awesome-icon icon="eye"/> </a>
                        <a v-if="show_edit" v-bind:href="show_edit+'/'+row.id+'/'+'edit'" class="btn btn-success"><font-awesome-icon icon="edit"/> </a>
                        <a v-if="show_delete" v-bind:href="show_delete+'/'+row.id+'/'+'delete'" class="btn btn-danger"><font-awesome-icon icon="times-circle"/> </a>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
        <div class="dv-footer">
            <div class="dv-footer-item">
                <span>Mostrando {{model.from}} - {{model.to}} de {{model.total}} filas</span>
            </div>
            <div class="dv-footer-item">
                <div class="dv-footer-sub">
                    <input type="text" v-model="query.per_page"
                           class="dv-footer-input form-control"
                           @keyup.enter="fetchIndexData()">
                    <span>Filas por páginas</span>
                </div>
                <div class="dv-footer-sub">
                    <button class="dv-footer-btn btn btn-success" @click="prev()"><font-awesome-icon icon="arrow-circle-left"/></button>
                    <input type="text" v-model="query.page"
                           class="dv-footer-input form-control"
                           @keyup.enter="fetchIndexData()">
                    <button class="dv-footer-btn btn btn-success" @click="next()"><font-awesome-icon icon="arrow-circle-right"/></button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import axios from 'axios'
    //similar to vue-resource
    export default {
        props: ['source', 'title','per_page','show_detail','show_edit','show_delete','show_new'],
        data() {
            var pp = this.per_page;
            if(!this.per_page)
                pp = 15;

            return {
                model: {},
                columns: {},
                labels: {},
                widths: {},
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'desc',
                    per_page: pp,
                    search_column: 'id',
                    search_operator: 'equal',
                    search_input: ''
                },
                operators: {
                    equal: '=',
                    not_equal: '<>',
                    less_than: '<',
                    greater_than: '>',
                    less_than_or_equal_to: '<=',
                    greater_than_or_equal_to: '>=',
                    in: 'IN',
                    like: 'LIKE'
                }
            }
        },
        created() {
            this.fetchIndexData()
        },
        methods: {
            next() {
                if(this.model.next_page_url) {
                    this.query.page++
                    this.fetchIndexData()
                }
            },
            prev() {
                if(this.model.prev_page_url) {
                    this.query.page--
                    this.fetchIndexData()
                }
            },
            toggleOrder(column) {
                if(column === this.query.column) {
                    // only change direction
                    if(this.query.direction === 'desc') {
                        this.query.direction = 'asc'
                    } else {
                        this.query.direction = 'desc'
                    }
                } else {
                    this.query.column = column
                    this.query.direction = 'asc'
                }
                this.fetchIndexData()
            },
            fetchIndexData() {
                var vm = this
                axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
                    .then(function(response) {
                        Vue.set(vm.$data, 'model', response.data.model)
                        Vue.set(vm.$data, 'columns', response.data.columns)
                        Vue.set(vm.$data, 'labels', response.data.labels)
                        Vue.set(vm.$data, 'widths', response.data.widths)
                    })
                    .catch(function(response) {
                        console.log(response)
                    })
            }
        }
    }
</script>