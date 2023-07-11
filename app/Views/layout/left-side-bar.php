<div class="left-side-bar">
    <div class="brand-logo">
        <a href="<?= site_url() ?>">
            <img alt="SMP Muhammadiyah Terpadu Moga" src="https://1.bp.blogspot.com/-B7A7C1t9jZ0/YVgV_tPm52I/AAAAAAAAAcw/rPg_1XQN_40Z3ifCif6TTLGGmlj04UhbwCLcBGAsYHQ/s418/putih-2.png" class="light-logo">
            <img alt="SMP Muhammadiyah Terpadu Moga" src="https://1.bp.blogspot.com/-aSEIz8QUj5E/YVgTCy-K4AI/AAAAAAAAAco/6Wnsukqv2UUrOay4c0HmPALgzpdCI24dACLcBGAsYHQ/s418/fix.png" class="dark-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <?php if (session('role') == 'owner') : ?>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <?php if (url_is('owner')) : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('owner/profile') || url_is('owner/profile/*')) : ?>
                            <a href="site_url('owner/profile')" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile></span>
                            </a>
                        <?php else : ?>
                            <a href="site_url('owner/profile')" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile></span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('teacher/subject') || url_is('teacher/subject/*')) : ?>
                            <a href="<?= $l3 ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-book"></span><span class="mtext"><?= $b3 ?></span>
                            </a>
                        <?php else : ?>
                            <a href="<?= $l3 ?>" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-book"></span><span class="mtext"><?= $b3 ?></span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                </ul>
            </div>
        </div>
    <?php endif ?>

    <?php if (session('role') == 'admin') : ?>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <?php if (url_is('admin')) : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('admin/profile') || url_is('admin/profile/*')) : ?>
                            <a href="<?= site_url('admin/profile') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('admin/profile') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('admin/user') || url_is('admin/user/*')) : ?>
                            <a href="<?= site_url('admin/user') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-people-fill"></span><span class="mtext">User</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('admin/user') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-people-fill"></span><span class="mtext">User</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                </ul>
            </div>
        </div>
    <?php endif ?>

    <?php if (session('role') == 'administration') : ?>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <?php if (url_is('administration')) : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('administration/profile') || url_is('administration/profile/*')) : ?>
                            <a href="<?= site_url('administration/profile') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('administration/profile') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('administration/student') || url_is('administration/student/*')) : ?>
                            <a href="<?= site_url('administration/student') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-people-fill"></span><span class="mtext">Siswa</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('administration/student') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-people-fill"></span><span class="mtext">Siswa</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('administration/subject') || url_is('administration/subject/*')) : ?>
                            <a href="<?= site_url('administration/subject') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-book"></span><span class="mtext">Mata Pelajaran</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('administration/subject') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-book"></span><span class="mtext">Mata Pelajaran</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('administration/timetable') || url_is('administration/timetable/*')) : ?>
                            <a href="<?= site_url('administration/timetable') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-calendar4-week"></span><span class="mtext">Jadwal</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('administration/timetable') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-calendar4-week"></span><span class="mtext">Jadwal</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                </ul>
            </div>
        </div>
    <?php endif ?>

    <?php if (session('role') == 'teacher') : ?>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <?php if (url_is('teacher')) : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url() ?>" class="dropdown-toggle no-arrow">
                                <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('teacher/profile') || url_is('teacher/profile/*')) : ?>
                            <a href="<?= site_url('teacher/profile') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('teacher/profile') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-torso"></span><span class="mtext">Profile</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if (url_is('teacher/subject') || url_is('teacher/subject/*')) : ?>
                            <a href="<?= site_url('teacher/subject') ?>" class="dropdown-toggle no-arrow active">
                                <span class="micon fi fi-book"></span><span class="mtext">Mata Pelajaran</span>
                            </a>
                        <?php else : ?>
                            <a href="<?= site_url('teacher/subject') ?>" class="dropdown-toggle no-arrow">
                                <span class="micon fi fi-book"></span><span class="mtext">Mata Pelajaran</span>
                            </a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>

                </ul>
            </div>
        </div>
    <?php endif ?>
</div>