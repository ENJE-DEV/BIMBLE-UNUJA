@extends('web.layouts.main')

@section('title','Bimble | Daftar Kursus')
@section('content')

<div class="container-fluid py-5 px-lg-5">

    <div class="row">
        <div class="col-lg-3 pt-3">
            <form action="{{ route('front.kursus') }}" class="pr-xl-3">
                <div class="mb-4">
                    <label for="form_search" class="form-label">Keyword</label>
                    <div class="input-label-absolute input-label-absolute-right">
                        <div class="label-absolute"><i class="fa fa-search"></i></div>
                        <input type="search" name="keyword" placeholder="Masukkan Keyword" {{ Request::get('keyword') }}
                            id="form_search" class="form-control pr-4">
                    </div>
                </div>
            </form>

            <form action="{{ route('front.kursus') }}">
                <div class="mb-4">
                    <label for="form_category" class="form-label">Kategori</label>
                    <select name="kategori" id="form_category" data-style="btn-selectpicker"
                        data-selected-text-format="count &gt; 1" title="" class="selectpicker form-control">
                        @if ($kategori->count() > 0)
                        <option value="">Semua</option>
                        @foreach ($kategori as $row)
                        <option value="{{$row->id}}">{{ $row->nama_kategori }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-filter mr-1"></i>Filter
                    </button>

                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row mb-4">
                    <div class="mr-3" style="color: #322F56">
                        
                        @if (Request::get('kategori') != null)
                        <strong>Kategori: <span class="text-item">{{ $nama_kategori }}</span> </strong>
                        @else
                        <strong>Semua Kategori</strong>
                        @endif
                    </div>
                    <div>
                        <label for="sort_price" class="form-label mr-2">Sort by</label>
                        <select name="sort_price" id="sort_price" data-style="btn-selectpicker" title="" class="selectpicker">
                            <option value="termahal">Termahal</option>
                            <option value="termurah">Termurah</option>
                        </select>
                    </div>
                </div>
                <div id="sortedData">
                <div class="row">
                    <!-- venue item-->
                    @forelse ($kursus as $krs)
                    <div data-marker-id="59c0c8e322f3375db4d89128" class="col-sm-6 col-xl-4 mb-5 hover-animate">
                        <div class="card card-kelas h-100 border-0 shadow">
                            <div class="card-img-top overflow-hidden gradient-overlay">
                                <img src="{{ Storage::url('public/'.$krs->gambar_kursus) }}"
                                    alt="{{ $krs->nama_kursus }}" class="img-fluid" style="height: 10em;"/><a
                                    href="{{ route('front.detail', [$krs->slug]) }}" class="tile-link"></a>
                                <div class="card-img-overlay-bottom z-index-20">
                                    <div class="media text-white text-sm align-items-center">
                                        @foreach ($krs->tutor as $sensei)
                                        <img src="{{ Storage::url('public/'.$sensei->foto) }}" alt="{{ $sensei->nama_tutor }}"
                                            class="avatar-profile avatar-border-white mr-2" height="50px"/>
                                        <div class="media-body">{{ $sensei->nama_tutor }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-img-overlay-top d-flex justify-content-between align-items-center">
                                <div class="badge badge-transparent badge-pill px-3 py-2">
                                    @foreach ($krs->kategori as $item)
                                    {{$item->nama_kategori}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <div class="w-100">
                                <h6 class="card-title"><a href="{{ route('front.detail', [$krs->slug]) }}"
                                        class="text-decoration-none text-dark">{{$krs->nama_kursus}}</a></h6>
                                <div class="d-flex card-subtitle mb-3">
                                    <p class="flex-grow-1 mb-0 text-muted text-sm">
                                        {{$krs->keterangan}}
                                    </p>
                                    <p class="flex-shrink-1 mb-0 card-stars text-xs text-right">
                                        @php
                                        $minat_kursus = $krs->order_detail_count/10;
                                        $rating = round($minat_kursus*2)/2;
                                        @endphp

                                        @for($x = 5; $x > 0; $x--)
                                        @php
                                        if($rating > 0.5) {
                                        echo '<i class="fa fa-star text-warning"></i>';
                                        } elseif($rating <= 0 ) { echo '<i class="fa fa-star text-gray-300"></i>' ; }
                                            else { echo '<i class="fa fa-star-half text-warning"></i>' ; } $rating--;
                                            @endphp @endfor </div> @if ($krs->diskon_kursus == 0)
                                            <p class="card-text text-muted"><span class="h4 text-primary">
                                                    @currency($krs->biaya_kursus)</span>
                                                per Bulan</p>
                                            @else
                                            <p class="card-text text-muted">
                                                <span class="h4 text-primary"> @currency($krs->biaya_kursus -
                                                    ($krs->biaya_kursus * ($krs->diskon_kursus/100)))</span>
                                                per Bulan
                                            </p>
                                            <p class="card-text ">
                                                <strike>
                                                    <span class="h6 text-danger">@currency($krs->biaya_kursus)</span>
                                                </strike>
                                                <strong class="ml-2">Diskon</strong> @currency($krs->diskon_kursus)%
                                            </p>
                                            @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col text-center mb-5">
                        <img width="200px"
                            src="https://i.pinimg.com/originals/ea/66/cd/ea66cdf309ec3341db8d38bb298afa0f.gif">
                        <p class="font-weight-bold mt-3" style="color: #071C4D;"> Pencarian tidak ditemukan
                        </p>
                        <a href="{{ route('front.kursus') }}" class="btn btn-primary btn-md">
                            <i class="fas fa-caret-left fa-1x"></i> Kembali
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('change','#sort_price',function() {
                let sort = $(this).val();

                $.ajax({
                    type:'get',
                    dataType: 'html',
                    url:'{{ url('/kursus_sort') }}',
                    data:'sorted=' + sort,
                    success:function(res) {
                        // console.log(res);
                        $("#sortedData").html(res);
                    },
                    error:function() {
                        
                    }
                });
            });
        });
    </script>
    @endpush
