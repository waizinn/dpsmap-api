<?php

class Paginator
{
    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    private $_export; // addition addition ########

    public function __construct($conn, $table, $export)
    {
        $this->_conn = $conn;
        $this->_query = "SELECT COUNT(1) FROM $table";
        $this->_export = $export; // addition addition ########

        $rs = $this->_conn->query($this->_query);
        $this->_total = mysqli_result($rs, 0, 0);
    }
    public function getData($limit = 30, $page = 1, $sql)
    {
        $this->_query = $sql;
        $this->_limit = $limit;
        $this->_page = $page;

        if ($this->_limit == 'all') {
            $query = $this->_query;
        } else {
            $offset = (($this->_page - 1) * $this->_limit);
            $query = $this->_query . " LIMIT " . $offset . ", $this->_limit";
        }
        $rs = $this->_conn->query($query);

        $results = array();
        while ($row = $rs->fetch_assoc()) {
            $results[] = $row;
        }

        $result = new stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->total = $this->_total;
        $result->data = $results;

        return $result;
    }

    public function append_existing_query_string($qstring)
    {
        if (isset($_GET)) {
            foreach ($_GET as $k => $v) {
                $qstring .= "&" . $k . "=" . $v;
            }
        }
        return $qstring;
    }

    public function createLinks($links, $list_class)
    {
        if ($this->_limit == 'all') {
            return '';
        }

        $last = ceil($this->_total / $this->_limit);

        $start = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html = '<ul class="' . $list_class . '">';

        $class = ($this->_page == 1) ? "disabled" : "";
        $back = ($this->_page == 1) ? "style='display:none;'" : ""; //addition #######
        //
        $qstring = '?limit=' . $this->_limit . '&page=' . ($this->_page - 1);
        $qstring = $this->append_existing_query_string($qstring);

        $qst = explode('&', $qstring); //addition #######
        $qstring = $qst[0] . "&" . $qst[1]; //addition #######
        $html .= '<li class="page-item disabled"><a class="page-link">Pages</a></li>';
        $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="' . $qstring . '" ' . $back . '>&laquo;</a></li>';

        if ($start > 1) {

            //
            $qstring = '?limit=' . $this->_limit . '&page=1';
            $qstring = $this->append_existing_query_string($qstring);
            $qst = explode('&', $qstring); //addition #######
            $qstring = $qst[0] . "&" . $qst[1]; //addition #######

            $html .= '<li class="page-item"><a class="page-link" href="' . $qstring . '">1</a></li>';
            $html .= '<li class="page-item disabled"><a class="page-link" href="">...</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($this->_page == $i) ? "active" : "";
            //
            $qstring = '?limit=' . $this->_limit . '&page=' . $i;
            $qstring = $this->append_existing_query_string($qstring);

            $qst = explode('&', $qstring); //addition #######
            $qstring = $qst[0] . "&" . $qst[1]; //addition #######
            //
            $html .= '<li class="page-item  ' . $class . '"><a class="page-link" href="' . $qstring . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="page-item  disabled"><a class="page-link">...</a></li>';
            //
            $qstring = '?limit=' . $this->_limit . '&page=' . $last;
            $qstring = $this->append_existing_query_string($qstring);

            $qst = explode('&', $qstring); //addition #######
            $qstring = $qst[0] . "&" . $qst[1]; //addition #######
            //
            $html .= '<li><a class="page-link" href="' . $qstring . '">' . $last . '</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";
        $front = ($this->_page == $last) ? "style='display:none;'" : ""; //addition #######
        $qstring = '?limit=' . $this->_limit . '&page=' . ($this->_page + 1);
        $qstring = $this->append_existing_query_string($qstring);

        $qst = explode('&', $qstring); //addition #######
        $qstring = $qst[0] . "&" . $qst[1]; //addition addition#######

        $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="' . $qstring . '" ' . $front . '>&raquo;</a></li>';
        $html .= '<li class="page-item disabled"><a class="page-link">Total ' . $this->_total . '</a></li>';
        if ($this->_export != '') {
            $html .= '<li class="page-item ' . $list_class . '"><a class="page-link" href="' . $this->_export . '">Export</a></li>';
        }

        $html .= '</ul>';
        //$html       .= '<span style="float:right;color:#1951e0">Total records : '.$this->_total.'</span>';

        return $html;
    }
}
