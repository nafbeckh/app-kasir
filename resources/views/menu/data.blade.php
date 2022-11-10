@extends('layouts.template')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="form-group row">
            <div class="col-sm-3">
                <select class="form-control" name="kategori" id="pilihKat">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Snack">Snack</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="input-group">
                    <input type="search" id="searchForm" name="search" class="form-control form-control" placeholder="Cari menu di sini">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="forItems">
        </div>
    </div>
</section>
<!-- /.content -->

<div class="modal animated fade fadeInDown" id="modalCart" role="dialog" aria-labelledby="modalCart" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Keranjang Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="container">
                        <div class="form-group row">
                            <label for="meja_id" class="col-sm-2 col-form-label">Meja :</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="meja_id" id="meja_id" required>
                                    <option>-- Pilih --</option>
                                    @foreach ($meja as $item)
                                    <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                                <span id="meja_id" class="error invalid-feedback" style="display: hide;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="container show-cart">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <h5 class="mr-auto" id="total-cart"></h5>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default clear-cart">Reset</button>
                <button type="button" class="btn btn-success">Pesan</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

<script>
    function hrg(x) {
        let a = parseInt(x)
        return a.toLocaleString('id-ID')
    }

    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            data: {search: ''},
            contentType: false,
            processData: false,
            success: function(res) {
                $('#forItems').html(res)
                // console.log(res)
            }
        });
    })

    $('#searchForm').on('keyup', function(){
        $.ajax({
            type: 'GET',
            data: $(this).serialize(),
            contentType: false,
            processData: false,
            success: function(res) {
                $('#forItems').html(res)
            }
        });
    })
    
    $('#pilihKat').change(function (){
            $.ajax({
                type: "GET",
                data: {
                    kategori: this.value,
                    search:  $('#searchForm').val()
                },
                success: function (res) {
                    $('#forItems').html(res)
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })
    
</script>
<script>
    var shoppingCart = (function() {
    // =============================
    // Private methods and propeties
    // =============================
    cart = [];
    
    // Constructor
    function Item(name, price, count) {
        this.name = name;
        this.price = price;
        this.count = count;
    }
    
    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
    }
    
        // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
    }
    

    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};
    
    // Add to cart
    obj.addItemToCart = function(name, price, count) {
        for(var item in cart) {
        if(cart[item].name === name) {
            cart[item].count ++;
            saveCart();
            return;
        }
        }
        var item = new Item(name, price, count);
        cart.push(item);
        saveCart();
    }
    // Set count from item
    obj.setCountForItem = function(name, count) {
        for(var i in cart) {
        if (cart[i].name === name) {
            cart[i].count = count;
            break;
        }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(name) {
        for(var item in cart) {
            if(cart[item].name === name) {
            cart[item].count --;
            if(cart[item].count === 0) {
                cart.splice(item, 1);
            }
            break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(name) {
        for(var item in cart) {
        if(cart[item].name === name) {
            cart.splice(item, 1);
            break;
        }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart 
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
        totalCount += cart[item].count;
        }
        return totalCount ? totalCount : '';
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
        totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for(i in cart) {
        item = cart[i];
        itemCopy = {};
        for(p in item) {
            itemCopy[p] = item[p];

        }
        itemCopy.total = Number(item.price * item.count).toFixed(2);
        cartCopy.push(itemCopy)
        }
        return cartCopy;
    }

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
    })();

    function addToCart(e) {
        var name = $(e).data('name');
        var price = Number($(e).data('price'));
        shoppingCart.addItemToCart(name, price, 1);
        displayCart();
    }

    // Clear items
    $('.clear-cart').click(function() {
        shoppingCart.clearCart();
        displayCart();
    });

    function displayCart() {
        var cartArray = shoppingCart.listCart();
        var output = "";
        for(var i in cartArray) {
            output += '<div class="card">'
                + '<div class="card-body">'
                + '<div class="row">'
                + '<div class="col-sm-6">'
                + '<h5 class="card-title"><b>' + cartArray[i].name + '</b></h5>'
                + '<p class="card-text">Rp '+ hrg(cartArray[i].price) +'</p></div>'
                + '<div class="col-sm text-right">'
                + '<div class="btn-group" role="group">'
                + '<button type="button" class="btn btn-default mr-2 minus-item" data-name="'+ cartArray[i].name +'"><i class="fas fa-minus"></i></button>'
                + '<input type="text" class="form-control text-center mr-2 item-count" style="width: 40px" name="jumlah" data-name="'+ cartArray[i].name +'" value="'+ cartArray[i].count +'">'
                + '<button type="button" class="btn btn-default mr-2 plus-item" data-name="'+ cartArray[i].name +'"><i class="fas fa-plus"></i></button>'
                + '<button type="button" class="btn btn-danger delete-item" data-name="'+ cartArray[i].name +'">Hapus</button>'
                + '</div></div></div></div></div>';
        }
        $('.show-cart').html(output);
        $('#total-cart').html('Total: Rp ' + hrg(shoppingCart.totalCart()));
        $('.total-count').html(shoppingCart.totalCount());
    }

    // Delete item button
    $('.show-cart').on("click", ".delete-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.removeItemFromCartAll(name);
        displayCart();
    })

    // -1
    $('.show-cart').on("click", ".minus-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.removeItemFromCart(name);
        displayCart();
    })
    
    // +1
    $('.show-cart').on("click", ".plus-item", function(event) {
        var name = $(this).data('name')
        shoppingCart.addItemToCart(name);
        displayCart();
    })

    // Item count input
    $('.show-cart').on("change", ".item-count", function(event) {
        var name = $(this).data('name');
        var count = Number($(this).val());
        shoppingCart.setCountForItem(name, count);
        displayCart();
    });

    displayCart();
</script>
@endpush
