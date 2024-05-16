@extends('layouts.app')
@section('content')  
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success'))
<script>
    Swal.fire({
      title: "Registrado!",
      text: "El sorteador ha sido registrado con éxito",
      icon: "success"
    });
</script>
  

@endif

@if (Session::has('error'))
<script>
    Swal.fire({
        title: "Error",
        text: "Ha ocurrido un error al registrar el sorteador, inténtelo más tarde",
        icon: "error"
    });
</script>
@endif

@endsection
</head>
<body>   
  <main>
    
  

  </main>
</body>
