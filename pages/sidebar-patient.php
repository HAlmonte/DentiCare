<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
            <a href="../dashboard/dashboard-patient.php" class="nav-link">
                <i class="nav-icon fa  fa-cube"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="../mapview/mapview.php" class="nav-link">
                <i class="nav-icon fa  fa-map"></i>
                <p>
                    Map View
                </p>
            </a>
        </li>
        
        <li class="nav-header">Manage</li>
        
        <li class="nav-item">
            <a href="../clinic/clinic-patient.php" class="nav-link">
                <i class="nav-icon fa  ion-ios-medkit"></i>
                <p>
                    Clinics
                </p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="../services/services-patient.php" class="nav-link">
                <i class="nav-icon fa  ion-android-list"></i>
                <p>
                    Services
                </p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="../reservation/reservation-patient.php" class="nav-link">
                <i class="nav-icon fa  ion-android-clipboard"></i>
                <p>
                    Reservation List
                </p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="../consultation/consultation-history-patient.php" class="nav-link">
                <i class="nav-icon fa ion-ios-browsers-outline"></i>
                <p>
                    Consultation History
                </p>
            </a>
        </li>
        
        <li class="nav-item">
            <?php
            echo "
            <a href='../patient/view-qr_code.php?patient_id=$user_id&patient_name=$user_full_name' class='nav-link'>
                <i class='nav-icon fa  fa-qrcode'></i>
                <p>
                    My QR Code
                </p>
            </a>
            ";
            ?>
        </li>
        
    </ul>
</nav>