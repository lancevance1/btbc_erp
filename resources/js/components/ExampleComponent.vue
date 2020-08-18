<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/products/create">Create a dry good</a>
                        <button type="button" class="btn btn-outline-info"  @click="test(`bottle`)">Bottle</button>
                        <button type="button" class="btn btn-outline-info"  @click="test(`carton`)">Carton</button>
                        <button type="button" class="btn btn-outline-info"  @click="test(`capsule`)">Capsule</button>
                        <button type="button" class="btn btn-outline-info"  @click="test(`divider`)">Divider</button>
                    </div>

                    <div class="card-body">

<!--                        @if (session('status'))-->
<!--                        <div class="alert alert-success" role="alert">-->
<!--                            {{ session('status') }}-->
<!--                        </div>-->
<!--                        @endif-->


                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th>Type</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                    <th>Current Inventory</th>
                                    <th>Order Quantity</th>
                                    <th>To be ordered</th>
                                    <th>Current Inventory Value</th>
                                    <th>Belong to</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="$product in products" v-if="$product.type === str">



                                    <td>{{$product.type}}

<!--                                        <button :click="location.href='/products/'"-->
<!--                                                type="button" class="btn btn-secondary">Edit-->
<!--                                        </button>-->
<!--                                        <form action="/products/{{$product.id}}" method="Post">-->

<!--                                            <button type="submit" class="btn btn-secondary">Delete</button>-->
<!--                                        </form>-->

                                        <button type="submit" class="btn btn-danger" v-on:click="deleteProd($product)">Delete</button>

                                    </td>
                                    <td><a :href="'/products/'+$product.id">{{$product.code}}</a>

                                    </td>
                                    <td>{{$product.description}}</td>
                                    <td>{{$product.price}}</td>
                                    <td>{{$product.cost}}</td>
                                    <td>{{$product.current_inventory}}</td>
                                    <td>{{$product.order_quantity}}</td>
                                    <td>{{$product.to_be_ordered}}</td>
                                    <td>{{$product.current_inventory_value}}</td>
                                    <td>{{$product.belong_to}}</td>


                                </tr>

                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            let str = 'bottle';
            return{
                products: [],
                str,
                response:[]
            }
        },

        mounted() {
            this.loadProducts();
            console.log('Component mounted.')
        },
        methods:{
            loadProducts: function(){
                axios.get('/api/products')
                    .then((response)=>{this.products= response.data.data;})
                    .catch((error)=>console.log(error));
            },
            test: function (str) {
                console.log(str);
                this.str = str;
            },
            deleteProd: function (prod) {

                axios.delete('/api/products/'+prod.id)
                    .then((response)=>{this.response= response.data.data;})
                    .catch((error)=>console.log(error));

                console.log(this.response);
            }
        }
    }
</script>
