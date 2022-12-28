<!DOCTYPE html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-2" id="root">

<h1>Test two way binding with AceBind</h1>

<div id="infoDiv" class="row">

<div class="col-md-6">
<label>Name:</label>
<input id="name" class="form-control" type="text" acebind="name"/>
<span class="fw-bold">name scope: <span class="fw-normal text-muted" acebind="name"></span></span>
</div>
<div class="col-md-6">
<button id="addLastnameBtn" class="btn btn-dark mt-4">Add lastname with binding</button>
</div>


</div>

</div>

<script type="module" src="test.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

