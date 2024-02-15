<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 bg-hero mb-5">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <h1 class="display-1 text-white mb-md-4">Tonase</h1>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Blog Start -->
<div class="container py-5">
    <div class="row g-5">
        <!-- Blog list Start -->
        <div class="col-lg-8">
            <div class="row g-5">
                <div class="col-md-12">
                    <div class="blog-item position-relative overflow-hidden">
                        <!-- <img class="img-fluid" src="img/blog-1.jpg" alt=""> -->
                        <table>
                            <tr>
                                <th>Unsur Pengukur Emisi CO2</th>
                                <th>Sampah Plastik</th>
                                <th>Sampah Kertas</th>
                                <th>Satuan</th>
                            </tr>
                            <tr>
                                <td>Bobot Sampah</td>
                                <td><?php echo round($bobotP = $TT->TOTALSAMPAH,2); ?></td>
                                <td><?php echo round($bobotK = $TT->TOTALSAMPAH,2); ?></td>
                                <td>Kg</td>
                            </tr>
                            <tr>
                                <?php $SW = 1000000; ?>
                                <td>SW (Bobot Solid Waste)</td>
                                <td><?php echo $SW1 = $bobotP / $SW; ?></td>
                                <td><?php echo $SW2 = $bobotK / $SW; ?></td>
                                <td>gr</td>
                            </tr>
                            <tr>
                                <td>DM (Dry Matter Content)</td>
                                <td><?php echo $DM1 = 1; ?></td>
                                <td><?php echo $DM2 = 0.9; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>CF (Carbon Fraction)</td>
                                <td><?php echo $CF1 = 0.75; ?></td>
                                <td><?php echo $CF2 = 0.46; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>FCF (Fosil Carbon Fraction)</td>
                                <td><?php echo $FCF1 = 1; ?></td>
                                <td><?php echo $FCF2 = 0.01; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>OF (Oxidation Factor)</td>
                                <td><?php echo $OF1 = 0.58; ?></td>
                                <td><?php echo $OF2 = 0.58; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>KF (C - CO2)</td>
                                <td><?php echo $KF1 = 44 / 12; ?></td>
                                <td><?php echo $KF2 = 44 / 12; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>Emisi CO2</td>
                                <td><?php echo $sumCO21 = $SW1 * $DM1 * $CF1 * $FCF1 * $OF1 * $KF1; ?></td>
                                <td><?php echo $sumCO22 = $SW2 * $DM2 * $CF2 * $FCF2 * $OF2 * $KF2; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td>TOTAL EMISI CO2</td>
                                <td> <?php echo $nilaiCO2 = $sumCO21 + $sumCO22; ?> </td>
                            </tr>
                        </table>
                        <!-- <a class="blog-overlay" href="">
                            <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                            <span class="text-white fw-bold">Jan 01, 2050</span>
                        </a> -->
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="blog-item position-relative overflow-hidden">
                        <img class="img-fluid" src="img/blog-2.jpg" alt="">
                        <a class="blog-overlay" href="">
                            <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                            <span class="text-white fw-bold">Jan 01, 2050</span>
                        </a>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="blog-item position-relative overflow-hidden">
                        <table>
                            <tr>
                                <th>Unsur Pengukur Emisi CH4</th>
                                <th>Sampah Plastik</th>
                                <th>Sampah Kertas</th>
                                <th>Satuan</th>
                            </tr>
                            <tr>

                                <td>SW (Bobot Solid Waste)</td>
                                <td><?php echo $SW1 = $bobotP / $SW; ?></td>
                                <td><?php echo $SW2 = $bobotK / $SW; ?></td>
                                <td>gr</td>
                            </tr>
                            <tr>
                                <td>CH4 Correction Factor</td>
                                <td><?php echo $CH41 = 6500 * 0.000001; ?></td>
                                <td><?php echo $CH42 = 6500 * 0.000001; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>Emisi CH4</td>
                                <td><?php echo $sumCH41 = $SW1 * $CH41; ?></td>
                                <td><?php echo $sumCH42 = $SW2 * $CH42; ?></td>
                                <td>gr</td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td>Total Emisi CH4</td>
                                <td> <?php echo $nilaiCH4 = $sumCH41 + $sumCH42; ?> gr</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                    <div class="blog-item position-relative overflow-hidden">
                        <img class="img-fluid" src="img/blog-1.jpg" alt="">
                        <a class="blog-overlay" href="">
                            <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                            <span class="text-white fw-bold">Jan 01, 2050</span>
                        </a>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="blog-item position-relative overflow-hidden">
                        <table>
                            <tr>
                                <th>Unsur Pengukur Emisi N2O</th>
                                <th>Sampah Plastik</th>
                                <th>Sampah Kertas</th>
                                <th>Satuan</th>
                            </tr>
                            <tr>

                                <td>SW (Bobot Solid Waste)</td>
                                <td><?php echo $SW1 = $bobotP / $SW; ?></td>
                                <td><?php echo $SW2 = $bobotK / $SW; ?></td>
                                <td>gr</td>
                            </tr>
                            <tr>
                                <td>N2O Factor</td>
                                <td><?php echo $N2O1 = 150 * 0.000001; ?></td>
                                <td><?php echo $N2O2 = 150 * 0.000001; ?></td>
                                <td>%</td>
                            </tr>
                            <tr>
                                <td>Emisi CH4</td>
                                <td><?php echo $sumN2O1 = $SW1 * $N2O1; ?></td>
                                <td><?php echo $sumN2O2 = $SW2 * $N2O2; ?></td>
                                <td>gr</td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td>Total Emisi N2O</td>
                                <td> <?php echo $nilaiN2O = $sumN2O1 + $sumN2O2; ?> gr</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="blog-item position-relative overflow-hidden">
                        <img class="img-fluid" src="img/blog-3.jpg" alt="">
                        <a class="blog-overlay" href="">
                            <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                            <span class="text-white fw-bold">Jan 01, 2050</span>
                        </a>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="blog-item position-relative overflow-hidden">
                        <table>
                            <tr>
                                <th>PARAMETER</th>
                                <th>EMISI (Gg)</th>
                                <th>FAKTOR KONVERSI</th>
                                <th>EMISI CO2-eq</th>
                            </tr>
                            <tr>

                                <td>CO2</td>
                                <td><?php echo $nilaiCO2; ?></td>
                                <td><?php echo 1; ?></td>
                                <td><?php echo $NCO2 = $nilaiCO2 * 1; ?></td>
                            </tr>
                            <tr>
                                <td>CH4</td>
                                <td><?php echo $nilaiCH4; ?></td>
                                <td><?php echo 25; ?></td>
                                <td><?php echo $NCH4 = $nilaiCH4 * 25; ?></td>
                            </tr>
                            <tr>
                                <td>N2O</td>
                                <td><?php echo $nilaiN2O; ?></td>
                                <td><?php echo 298; ?></td>
                                <td><?php echo $NN20 = $nilaiN2O * 298; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td>TOTAL EMISI CO2-eq</td>
                                <td> <?php echo $CO2eq = $NCO2 + $NCH4 + $NN20; ?></td> Ggr CO2-eq
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>

                                <td> <?php echo $CO2eq * 1000; ?></td>Ton-CO2-eq
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="blog-item position-relative overflow-hidden">
                        <img class="img-fluid" src="img/blog-2.jpg" alt="">
                        <a class="blog-overlay" href="">
                            <h4 class="text-white">Lorem elitr magna stet eirmod labore amet</h4>
                            <span class="text-white fw-bold">Jan 01, 2050</span>
                        </a>
                    </div>
                </div> -->
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg justify-content-center m-0">
                            <!-- <li class="page-item disabled">
                                <a class="page-link rounded-0" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                                </a>
                            </li> -->
                            <!-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <!-- <li class="page-item">
                                <a class="page-link rounded-0" href="#" aria-label="Next">
                                    <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                                </a>
                            </li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Blog list End -->

        <!-- Sidebar Start -->
        <div class="col-lg-4">


            <!-- Category Start -->
            <div class="mb-5">
                <!-- <h2 class="mb-4">Categories</h2> -->
                <div class="d-flex flex-column justify-content-start bg-primary p-4">

                    <table>
                        <tr>
                            <!-- <th class="fs-5 fw-bold text-white mb-2">Company</th> -->
                            <th class="fs-5 fw-bold text-white mb-2">Konversi Kg ke Ggr</th>

                        </tr>
                        <tr>

                            <td class="fs-5 fw-bold text-white mb-2">12,040</td>
                            <td class="fs-5 fw-bold text-white mb-2">0.012040</td>
                        </tr>
                        <tr>
                            <!-- <th class="fs-5 fw-bold text-white mb-2">Company</th> -->
                            <th class="fs-5 fw-bold text-white mb-2">Konversi Kg ke Ggr</th>

                        </tr>
                        <tr>

                            <td class="fs-5 fw-bold text-white mb-2">12,000</td>
                            <td class="fs-5 fw-bold text-white mb-2">0.012000</td>
                        </tr>
                    </table>

                    <!-- <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Design</a>
                    <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Development</a>
                    <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Web Development</a>
                    <a class="fs-5 fw-bold text-white mb-2" href="#"><i class="bi bi-arrow-right me-2"></i>Keyword Research</a>
                    <a class="fs-5 fw-bold text-white" href="#"><i class="bi bi-arrow-right me-2"></i>Email Marketing</a> -->
                </div>
            </div>
            <!-- Category End -->
            <!-- Image Start -->
            <div class="mb-5">
                <img src="img/blog-1.jpg" alt="" class="img-fluid rounded">
            </div>
            <!-- Image End -->

            <!-- Plain Text Start -->
            <div>
                <!-- <h2 class="mb-4">Plain Text</h2> -->
                <div class="bg-primary text-center text-white" style="padding: 30px;">

                    <table style="width:100%">

                        <tr>
                            <th>Tahun</th>
                            <th>Total Timbulan Sampah</th>
                            <th>Kategori</th>
                        </tr>
                        <?php foreach ($T as $Tonase) { ?>
                            <tr>
                                <td><?php echo $Tonase->TAHUN; ?> </td>
                                <td><?php echo round($Tonase->TOTALSAMPAH, 2); ?></td>
                                <td><?php echo $Tonase->KATEGORI; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <!-- <p>Vero sea et accusam justo dolor accusam lorem consetetur, dolores sit amet sit dolor clita kasd justo, diam accusam no sea ut tempor magna takimata, amet sit et diam dolor ipsum amet diam</p>
                    <a href="" class="btn btn-secondary py-2 px-4">Read More</a> -->
                </div>
            </div>
            <!-- Plain Text End -->
        </div>
        <!-- Sidebar End -->
    </div>
</div>
<!-- Blog End -->
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>