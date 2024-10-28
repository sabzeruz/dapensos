<!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Data Products - SantriKoding.com</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
   </head>
   <body style="background: lightgray">
     <div class="container mt-5">
       <div class="row">
         <div class="col-md-12">
           <div>
             <h3 class="text-center my-4"> Laravel 11 </h3>
             <h5 class="text-center">
               <a href="https://poliban.ac.id">poliban.ac.id</a>
             </h5>
             <hr>
           </div>
           <div class="card border-0 shadow-sm rounded">
             <div class="card-body">
               <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3  "><i class="fa-solid fa-plus fa-fw "></i>Tambah Produk</a>
               <table class="table table-bordered table-responsive text-center ">
                 <thead>
                   <tr>
                     <th scope="col">IMAGE</th>
                     <th scope="col">TITLE</th>
                     <th scope="col">PRICE</th>
                     <th scope="col">STOCK</th>
                     <th scope="col" style="width: 20%">ACTIONS</th>
                   </tr>
                 </thead>
                 <tbody> @forelse ($products as $product)
                     <tr>
                            <td class="text-center">
                            <img src="{{ asset('/storage/products/'.$product->image) }}" style="max-width: 20vh"> 
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ "Rp " . number_format($product->price,2,',','.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-arrow-up-right-from-square"></i> SHOW</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-gear"></i> EDIT</a> 
                                @csrf @method('DELETE') 
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i> HAPUS</button>
                            </form>
                            </td>
                   </tr> @empty <div class="alert alert-danger"> Data Products belum Tersedia. </div> @endforelse </tbody>
               </table>
               {{ $products->links() }}
             </div>
           </div>
         </div>
       </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://kit.fontawesome.com/b33efb04f1.js" crossorigin="anonymous"></script>

     <script>
       //message with sweetalert 
       @if(session('success')) Swal.fire({
         icon: "success",
         title: "BERHASIL",
         text: "{{ session('success') }}",
         showConfirmButton: false,
         timer: 2000
       });
       @elseif(session('error')) Swal.fire({
         icon: "error",
         title: "GAGAL!",
         text: "{{ session('error') }}",
         showConfirmButton: false,
         timer: 2000
       });
       @endif
     </script>
   </body>
 </html>