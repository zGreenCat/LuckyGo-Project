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
    
@endsection
</head>
<body>   
  <main>
    
  

  </main>
</body>
