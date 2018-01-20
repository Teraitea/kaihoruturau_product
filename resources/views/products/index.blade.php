<!-- index.blade.php -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index Page</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">
    <h1>Listes des produits</h1>
    
    <div class="row">
          <div class="col-md-10"></div>
            <a href="{{action('ProductController@create')}}" class="btn btn-success">Add a new product</a>
        </div>
    <br />

    @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
    <table id='myTable' class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Image</th>
        <th>Fournisseur</th>
        <th>Catégorie</th>
        <th>Qauntité</th>
        <th>Prix</th>
        <th colspan="1">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{  $product['id']}}</td>
        <td>{{  $product['name']}}</td>
        <!-- <td><img src="images/{{   $product['image'] }}" width="50"></td> -->
        <td>{{  $product['image'] }}</td>
        <td>{{  $product['supplier_id']}}</td>
        <td>{{  $product['product_category_id']}}</td>
        <td>{{  $product['quantity']}}</td>
        <td>{{  $product['price']}} xpf</td>
        <td><a href="{{action('ProductController@edit', $product['id'])}}" class="btn btn-success "><i class="glyphicon glyphicon-pencil"></i></a></td>
        <td>
          <form action="{{action('ProductController@destroy', $product['id'])}}" method="post">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#myTable').DataTable();
    });
  </script>
  </body>
</html>