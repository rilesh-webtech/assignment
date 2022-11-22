<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Books</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<style type="text/css">
  table {
   overflow:hidden;
  }
  table tr:not('.slide-out') {
    transform:translateX(-100%);
  }
  table th, table td {
    padding:.25em .5em;
    text-align:left;
    vertical-align:top;
  }
  tbody tr{
    transition:all 1s ease-in-out;
  }
  tbody .slide-out {
      transform:translateX(-100%);
  }
</style>
<body>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="container">
            <h2 class="mb-4">{{($title) ? 'Seach result of "'.$title.'"': 'All Books' }} </h2>
            <form method="get" action="{{ route('searchbook') }}">
                <div class="input-group p-0 mb-3 col-md-6">
                  <input class="form-control py-2 border-right-0 border" name="title" value="{{$title}}" type="input" placeholder="Search by name" id="example-search-input">
                  <span class="input-group-append">
                    <button class="btn btn-outline-secondary border" type="submit">
                          Search
                    </button>
                    <!-- <button class="btn btn-outline-secondary border" type="reset">
                          clear
                  </button> -->
                  </span>
                  
              </div>
            </form>
            <?php if (count($books) > 0) { ?>
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">Publish Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($books as $key => $book): ?>
                    <tr>
                      <th scope="row">{{$key+1}}</th>
                      <td>{{$book->title}}</td>
                      <td>{{$book->author->name}}</td>
                      <td>{{date("d-m-Y",strtotime($book->publish_on))}}</td>
                    </tr>
                  <?php
                  endforeach ?>
                </tbody>
              </table>
            <?php }else{ ?>
                <h4 class="text-left">No result found</h2>
            <?php } ?>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
  const rows = Array.from(document.querySelectorAll('tr'));

function slideOut(row) {
  row.classList.add('slide-out');
}

function slideIn(row, index) {
  setTimeout(function() {
    row.classList.remove('slide-out');
  }, (index + 5) * 200);  
}

rows.forEach(slideOut);
rows.forEach(slideIn);
</script>
</html>
