import React, { useState, useEffect } from "react";
import { makeStyles } from '@material-ui/core/styles';
import { Link } from "react-router-dom";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import Divider from "@material-ui/core/Divider";
import FormControl from "@material-ui/core/FormControl";
import CurrencyTextField from '@unicef/material-ui-currency-textfield'
import PageBase from "../../../components/PageBase";
import styles from "./styles";
import { useDispatch } from "react-redux";
import api from "../../../services/api";
import Chip from '@material-ui/core/Chip';
import Paper from "@material-ui/core/Paper";
import InputAdornment from '@material-ui/core/InputAdornment';
import AddCircleIcon from '@material-ui/icons/AddCircle';
import InputLabel from '@material-ui/core/InputLabel';
import IconButton from '@material-ui/core/IconButton';
import Input from '@material-ui/core/Input';
import Grid from '@material-ui/core/Grid';
import FormHelperText from '@material-ui/core/FormHelperText';

const useStyles = makeStyles((theme) => ({
  formPadding: {
    paddingTop: 20, 
    paddingBottom: 20
  },
  tagPaper: {
    padding: 20
  },
  tagChip: {
    margin: 4
  }
}));

const ProductForm = (props) => {
  const dispatch = useDispatch()
  const classes = useStyles();

  const [editMode, setEditMode] = useState(false)
  
  const [product, setProduct] = useState({
      name: '',
      price: '',
      available_quantity: '',
      tags: []
  })

  const [loading, setLoading] = useState(false)
  const [newTag, setNewTag] = useState('')

  useEffect(() => {
    if (props.match.params.product) {
      setEditMode(true)
      api.get(`/product/${props.match.params.product}`)
        .then((res) => {
          let newProduct = res.data.data
          newProduct.tags = JSON.parse(newProduct.tags)
          setProduct(newProduct)
        })
    }
  },[])

  const handleSubmit = (event) => {
    event.preventDefault()
    setLoading(true)
    let productData = {...product}
    productData.tags = JSON.stringify(product.tags)

    if (editMode) {
      api.patch(`/product/${product.id}`, productData)
      .then((res) => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Produto ${res.data.data.name} alterado com sucesso`})
          props.history.push('/produtos')
        })
    } else {
      api.post('/product', productData)
      .then((res) => {
          dispatch({type: 'SNACKBAR_SHOW', message: `Produto ${res.data.data.name} criado com sucesso`})
          props.history.push('/produtos')
        })
    }
  }

  const handleDeleteTag = (deleteIndex) => {
    let allTags = product.tags
    allTags = allTags.filter((tag, index) => index !== deleteIndex)
    setProduct({...product, tags: allTags})
  }

  const handleClickNewTag = (e) => {
    e.preventDefault();
    if (newTag !== '') {
      const allTags = product.tags
      allTags.push(newTag)
      setNewTag('')
      setProduct({...product, tags: allTags})
    }
  };

  const handleMouseDownNewTag = (event) => {
    event.preventDefault();
  };

  return (
    <PageBase title={editMode ? "Editar Produto" : "Novo Produto"}>
      <form autoComplete="off" onSubmit={handleSubmit}>
        {/* Name */}
        <TextField
          label="Nome"
          fullWidth={true}
          margin="normal"
          value={product.name}
          required
          onChange={(e) => setProduct({...product, name: e.target.value})}
        />

        <FormControl>
          <Grid container spacing={2}>
            <Grid item lg={6} md={6} sm={6} xs={12}>
              {/* Price */}
              <CurrencyTextField
                required
                label="Preço"
                fullWidth={true}
                value={product.price}
                currencySymbol="R$"
                decimalCharacter=","
                digitGroupSeparator="."
                onChange={(e, value) => setProduct({...product, price: value})}
              />
            </Grid>
            {/* Available Quantity */}
            <Grid item lg={6} md={6} sm={6} xs={12} >
              <TextField
                label="Quantidade disponível"
                value={product.available_quantity}
                fullWidth={true}
                required
                type="number"
                onChange={(e) => setProduct({...product, available_quantity: e.target.value})}
              />
            </Grid>
          </Grid>
        </FormControl>
        {/* New Tag */}
        <FormControl fullWidth className={classes.formPadding}>
          <InputLabel htmlFor="add-new-tag" className={classes.formPadding}>Nova Tag</InputLabel>
          <Input
            id="add-new-tag"
            type='text'
            fullWidth={true}
            value={newTag}
            onChange={(e) => setNewTag(e.target.value)}
            onKeyPress={(e) => { e.key === 'Enter' && handleClickNewTag(e) }}
            endAdornment={
              newTag !== '' &&
              <InputAdornment position="end">
                <IconButton
                  aria-label="toggle password visibility"
                  onClick={handleClickNewTag}
                  onMouseDown={handleMouseDownNewTag}
                >
                  <AddCircleIcon />
                </IconButton>
              </InputAdornment>
            }
          />
        </FormControl>
        {/* Tag List */}
        
        <FormHelperText>Tags</FormHelperText>
        <FormControl fullWidth>
          {product.tags.length > 0 && 
            <Paper variant="outlined" className={classes.tagPaper}>
              {product.tags.map((tag, index) => (
                <Chip key={index} size="small" color="primary" label={tag} variant="outlined" className={classes.tagChip} onDelete={() => handleDeleteTag(index)} />
              ))}
            </Paper>
          }
        </FormControl>

        <Divider />

        <div style={styles.buttons}>
          <Link to="/produtos">
            <Button variant="contained">Voltar</Button>
          </Link>

          <Button
            style={styles.saveButton}
            variant="contained"
            type="submit"
            color="primary"
            disabled={loading}
          >
            Salvar
          </Button>
        </div>
      </form>
    </PageBase>
  );
};

export default ProductForm;
