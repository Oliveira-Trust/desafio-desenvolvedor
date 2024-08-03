import { DataGrid } from '@mui/x-data-grid';
import styles from './styles/DataTable.module.css';

const DataTable = (props) => {
  return (
    <div className={styles.main}>
      <div style={{ height: 400, width: '100%' }}>
        <DataGrid
          rows={props.rows}
          columns={props.columns}
          initialState={{
            pagination: {
              paginationModel: { page: 0, pageSize: 5 },
            },
          }}
          pageSizeOptions={[5, 10]}
          getRowId={() => Math.floor(Math.random() * 100000000)}
        />
      </div>
    </div>
  )
}

export default DataTable;