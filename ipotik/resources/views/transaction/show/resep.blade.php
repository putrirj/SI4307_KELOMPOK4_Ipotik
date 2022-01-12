@extends('layout.app')
@section('layout_title', 'Detail Transaksi')
@section('layout_content')
    <main class="mb-5 p-3 section-banner" style="height: 100%;">
        <div class="container p-0 col-lg-8">
            <section id="menu">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <p class="h4 text-center mt-3 mb-3">Detail Resep</p>
                        <div class="col-12 mb-3">
                            <div class="table-responsive">
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <h5>Resep</h5>
                            <div class="row">
                                @if ($transaction->file_type == 'image')
                                    <img src="{{ asset('storage/'.$transaction->file) }}" class="w-100 h-auto">
                                @else
                                    <canvas id="pdf" class="w-100 h-auto"></canvas>
                                    <div id="navigation_controls" class="text-center d-inline mt-4">
                                        <button id="go_previous" class="btn btn-primary">Previous</button>
                                        <input id="current_page" value="1" type="number" class="form-control w-25 d-inline"/>
                                        <button id="go_next" class="btn btn-primary">Next</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
@if ($transaction->file_type == 'pdf')
@section('layout_script_include')
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js">
  </script>
@endsection
@section('layout_script')
    var myState = {
        pdf: null,
        currentPage: 1,
        zoom: 1
    }
    
    pdfjsLib.getDocument("{{ asset('storage/'.$transaction->file) }}").then((pdf) => {
    
        myState.pdf = pdf;
        render();

    });

    function render() {
        myState.pdf.getPage(myState.currentPage).then((page) => {
        
            var canvas = document.getElementById("pdf");
            var ctx = canvas.getContext('2d');
    
            var viewport = page.getViewport(myState.zoom);

            canvas.width = viewport.width;
            canvas.height = viewport.height;
        
            page.render({
                canvasContext: ctx,
                viewport: viewport
            });
        });
    }

    document.getElementById('go_previous').addEventListener('click', (e) => {
        if(myState.pdf == null || myState.currentPage == 1) 
            return;
        myState.currentPage -= 1;
        document.getElementById("current_page").value = myState.currentPage;
        render();
    });

    document.getElementById('go_next').addEventListener('click', (e) => {
        if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
            return;
        myState.currentPage += 1;
        document.getElementById("current_page").value = myState.currentPage;
        render();
    });

    document.getElementById('current_page').addEventListener('keypress', (e) => {
        if(myState.pdf == null) return;
        
        // Get key code
        var code = (e.keyCode ? e.keyCode : e.which);
        
        // If key code matches that of the Enter key
        if(code == 13) {
            var desiredPage = 
            document.getElementById('current_page').valueAsNumber;
                                
            if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
                myState.currentPage = desiredPage;
                document.getElementById("current_page").value = desiredPage;
                render();
            }
        }
    });
@endsection
@endif