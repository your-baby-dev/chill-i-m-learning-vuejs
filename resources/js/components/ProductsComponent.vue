<template>
    <!--    i faut toujours une div pour englober le contenu d'un component-->
    <div>
        <input v-model="q" type="text" placeholder="Recherche par mots-clés" class="form-control">
        <div class="container">
            <div class="row text-center">
                <!--        pour chaque produit dans produits-->
                <div v-for="product in getFilteredProd" class="my-auto mx-auto">
                    <!--            ici c po obligé mais on appelle le produc component en lui passant les values -->
                    <div class="card h-100 rounded" style="min-height: 42rem; max-height: 42rem; width: 18rem; margin-left: 3rem; margin-right: 3rem; margin-top: 3rem; margin-bottom: 3rem;">
                        <img :src="product.thumbnail" :alt="product.name" class="card-img-top" >
                        <div class="card-header">
                            <span class="card-title font-weight-bold">{{ product.name }}</span>
                        </div>
                        <div class="card-body relative">
                            <p class="card-text absolute absolute-45">{{ product.description }}</p>
                        </div>
                        <div v-on:click="addCart(product)" class="card-footer bg-primary">
                            <button class="btn btn-primary">{{product.price}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="listCart.length > 0" class="bottom-0 right-0 fixed m-3 card bg-danger text-white">
            <span class="card-header">Panier</span>
            <div v-for="itemcart in listCart">
                <panier-component :name="itemcart.name" :amount="getAmount(itemcart)" :price="itemcart.price" :total="getTotalAmount(itemcart)"/>
            </div>
            <span class="card-footer">Total:</span>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                listCart: [],
                products: [],
                q: '',
            }
        },

        methods: {
            getProductOnProducts: function () {
                axios.get('/products')
                    .then(response => {
                        this.products = Object.values(response.data.items).flat();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            addCart: function (product) {
                let found = false;
                let itemIndex = -1;
                let itemTotal = 0

                this.listCart.forEach(function (item, index) {
                    if (item.name === product.name && item.price === product.price) {
                        itemIndex = index;
                        itemTotal = item.price * item.amount;
                        found = true;
                    }
                });

                if (found) {
                    this.listCart[itemIndex].amount++;

                    console.log(itemIndex);
                    console.log(itemTotal);

                    return;
                }

                console.log(this.listCart);

                this.listCart.push({
                    name: product.name,
                    price: product.price,
                    amount: 1,
                    total : product.total
                });
            },

            getAmount: function (product) {
                let amount = 0;

                this.listCart.forEach(function (item) {
                    if (item.name === product.name && item.price === product.price) {
                        amount = item.amount;
                    }
                });
                return amount;
            },
            getTotalAmount: function (product) {
                let total = 0;

                this.listCart.forEach(function (item) {
                    if (item.name === product.name && item.price === product.price) {
                        total = item.total
                    }
                });
                return total;
            }

        },

        computed: {
            getFilteredProd() {
                return this.products.filter(product => {
                    return product.description.toLowerCase().includes(this.q.toLowerCase())
                })
            },
        },

        mounted() {
            this.getProductOnProducts();
        },
    }

</script>

<!--var quantity = document.getElementsByName("item.amount");-->
<!--var price = document.getElementsByName("item.price");-->
<!--var total = 0;-->
<!--for (var i = 0; i < 8; i++) {-->
<!--total += parseInt(item.amount[i].value || 0, 10) * parseInt(item.price[i].value || 0, 10);-->
<!--}-->
<!--document.getElementById("runtotal").innerHTML = total;-->
<!--}-->
