
function App() {
  return (
    <div>
      <ProductList />
      <h1>test</h1>
    </div>
  );
}

ReactDOM.render(
  <App />,
  document.getElementById('root')
);

export default class ProductList extends React.Component {
  // state = {
  //   products: [],
  // };

  // componentDidMount(){
  //   axios.get(`https://beta.beangasm.id/api/store/product/18/all`).then(res => {
  //     console.log(res);
  //     this.setState({ products: res.data.product_store_data.products.data });
  //   });
  // };

  render(){
    return(
      <ul>
        {/* {this.state.products.map(product => <li>{product.title}</li>)} */}
        test 2
      </ul>
    )
  };
}